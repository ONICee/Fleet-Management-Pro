<?php
require_once __DIR__ . '/../core/BaseController.php';

class FuelController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);
        
        try {
            require_once __DIR__ . '/../models/FuelRecord.php';
            $fuelModel = new FuelRecord($this->db);

            try {
                // Get fuel records with vehicle and driver details
                $fuelRecords = $fuelModel->getFuelRecordsWithDetails();
                $fuelStats = $fuelModel->getFuelStats();
            } catch (Exception $e) {
                // Likely table missing; log and continue with defaults
                error_log('FuelController error: ' . $e->getMessage());
                $fuelRecords = [];
                $fuelStats = [
                    'total_records'=>0,
                    'monthly_cost'=>0,
                    'monthly_quantity'=>0,
                    'avg_price'=>0
                ];
            }
            
            $data = [
                'pageTitle' => 'Fuel Records - State Fleet Management System',
                'fuelRecords' => $fuelRecords,
                'stats' => $fuelStats
            ];
            
            $this->logActivity('view', 'fuel_records');
            $this->renderView('fuel/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
    
    public function record() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);

        require_once __DIR__ . '/../models/Vehicle.php';
        require_once __DIR__ . '/../models/Driver.php';
        require_once __DIR__ . '/../models/FuelRecord.php';

        $vehicleModel = new Vehicle($this->db);
        $driverModel  = new Driver($this->db);
        $fuelModel    = new FuelRecord($this->db);

        if ($this->isPost()) {
            $this->validateCSRF();

            $input = $this->sanitizeInput($_POST);

            // Calculate total cost if not provided / trusted from UI
            $input['total_cost'] = (float)$input['quantity'] * (float)$input['price_per_unit'];

            // Validation rules
            $rules = [
                'vehicle_id'      => 'required|numeric',
                'fuel_station'    => 'required|max:100',
                'fuel_type'       => 'required',
                'quantity'        => 'required|numeric',
                'price_per_unit'  => 'required|numeric',
                'fuel_date'       => 'required|date'
            ];

            $errors = $this->validateInput($input, $rules);

            if (!empty($errors)) {
                $this->session->setFlashMessage('error', 'Please correct the highlighted errors.');
                $this->redirect('/fuel/record');
            }

            try {
                $fuelModel->createFuelRecord($input);
                $this->logActivity('create','fuel_record',null,null,$input);
                $this->session->setFlashMessage('success','Fuel record added successfully.');
                $this->redirect('/fuel');
            } catch (Exception $e) {
                $this->session->setFlashMessage('error','Failed to save record: '.$e->getMessage());
                $this->redirect('/fuel/record');
            }
        }

        // GET request – show form
        $data = [
            'pageTitle' => 'Record Fuel - State Fleet Management System',
            'vehicles'  => $vehicleModel->findAll([], 'vehicle_brand'),
            'drivers'   => $driverModel->findAll([], 'id')
        ];

        $this->renderView('fuel/record', $data);
    }
}
<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/Agency.php';

class VehicleController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        
        $vehicleModel = new Vehicle($this->db);
        $agencyModel = new Agency($this->db);
        
        try {
            // Handle filters
            $filters = [];
            if (!empty($_GET['search'])) {
                $filters['search'] = $_GET['search'];
            }
            if (!empty($_GET['agency'])) {
                $filters['agency_id'] = $_GET['agency'];
            }
            if (!empty($_GET['filter'])) {
                $filters['serviceability'] = $_GET['filter'];
            }
            if (!empty($_GET['vehicle_type'])) {
                $filters['vehicle_type'] = $_GET['vehicle_type'];
            }
            
            // Get vehicles with filters
            $vehicles = $vehicleModel->getVehiclesWithDetails($filters);
            
            // Get agencies for filters
            $agencies = $agencyModel->findAll();
            
            // Get vehicle statistics
            $stats = $vehicleModel->getVehicleStats();
            
            $data = [
                'pageTitle' => 'Vehicle Management - State Fleet Management System',
                'vehicles' => $vehicles,
                'agencies' => $agencies,
                'stats' => $stats
            ];
            
            $this->logActivity('view', 'vehicles');
            $this->renderView('vehicles/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
    
    public function create() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            // Handle form submission
            $data = $this->sanitizeInput($_POST);
            
            try {
                $vehicleModel = new Vehicle($this->db);
                $vehicleId = $vehicleModel->createVehicle($data);
                
                $this->logActivity('create', 'vehicle', $vehicleId, null, $data);
                $this->session->setFlashMessage('success', 'Vehicle added successfully!');
                $this->redirect('/vehicles');
                
            } catch (Exception $e) {
                $this->session->setFlashMessage('error', 'Failed to add vehicle: ' . $e->getMessage());
            }
        }
        
        // Show create form
        $agencyModel = new Agency($this->db);
        $agencies = $agencyModel->findAll();
        
        // Also get deployment locations
        require_once __DIR__ . '/../models/DeploymentLocation.php';
        $locationModel = new DeploymentLocation($this->db);
        $locations = $locationModel->getAllLocations();
        
        $data = [
            'pageTitle' => 'Add New Vehicle - State Fleet Management System',
            'agencies' => $agencies,
            'locations' => $locations
        ];
        
        $this->renderView('vehicles/create', $data);
    }
    
    public function edit() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);
        
        $id = $this->params['id'] ?? null;
        
        if (!$id) {
            $this->session->setFlashMessage('error', 'Vehicle ID not provided');
            $this->redirect('/vehicles');
        }
        
        $vehicleModel = new Vehicle($this->db);
        $vehicle = $vehicleModel->find($id);
        
        if (!$vehicle) {
            $this->session->setFlashMessage('error', 'Vehicle not found');
            $this->redirect('/vehicles');
        }
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            $data = $this->sanitizeInput($_POST);
            
            try {
                $oldValues = $vehicle;
                $vehicleModel->updateVehicle($id, $data);
                
                $this->logActivity('update', 'vehicle', $id, $oldValues, $data);
                $this->session->setFlashMessage('success', 'Vehicle updated successfully!');
                $this->redirect('/vehicles');
                
            } catch (Exception $e) {
                $this->session->setFlashMessage('error', 'Failed to update vehicle: ' . $e->getMessage());
            }
        }
        
        // Show edit form
        $agencyModel = new Agency($this->db);
        $agencies = $agencyModel->findAll();
        
        // Also get deployment locations
        require_once __DIR__ . '/../models/DeploymentLocation.php';
        $locationModel = new DeploymentLocation($this->db);
        $locations = $locationModel->getAllLocations();
        
        $data = [
            'pageTitle' => 'Edit Vehicle - State Fleet Management System',
            'vehicle' => $vehicle,
            'agencies' => $agencies,
            'locations' => $locations
        ];
        
        $this->renderView('vehicles/edit', $data);
    }
    
    public function view() {
        $this->requireLogin();
        
        $id = $this->params['id'] ?? null;
        
        if (!$id) {
            $this->session->setFlashMessage('error', 'Vehicle ID not provided');
            $this->redirect('/vehicles');
        }
        
        $vehicleModel = new Vehicle($this->db);
        $vehicles = $vehicleModel->getVehiclesWithDetails(['id' => $id]);
        
        if (empty($vehicles)) {
            $this->session->setFlashMessage('error', 'Vehicle not found');
            $this->redirect('/vehicles');
        }
        
        $vehicle = $vehicles[0];
        
        // Get maintenance history using the new model
        require_once __DIR__ . '/../models/MaintenanceHistory.php';
        $maintenanceHistoryModel = new MaintenanceHistory($this->db);
        $maintenanceHistory = $maintenanceHistoryModel->getVehicleMaintenanceHistory($id, 10);
        
        $data = [
            'pageTitle' => 'Vehicle Details - State Fleet Management System',
            'vehicle' => $vehicle,
            'maintenanceHistory' => $maintenanceHistory
        ];
        
        $this->logActivity('view', 'vehicle', $id);
        $this->renderView('vehicles/view', $data);
    }
    
    public function delete() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin']);
        
        if (!$this->isPost()) {
            $this->session->setFlashMessage('error', 'Invalid request method');
            $this->redirect('/vehicles');
        }
        
        $this->validateCSRF();
        
        $id = $this->params['id'] ?? null;
        
        if (!$id) {
            $this->session->setFlashMessage('error', 'Vehicle ID not provided');
            $this->redirect('/vehicles');
        }
        
        try {
            $vehicleModel = new Vehicle($this->db);
            $vehicle = $vehicleModel->find($id);
            
            if (!$vehicle) {
                $this->session->setFlashMessage('error', 'Vehicle not found');
                $this->redirect('/vehicles');
            }
            
            $vehicleModel->delete($id);
            
            $this->logActivity('delete', 'vehicle', $id, $vehicle);
            $this->session->setFlashMessage('success', 'Vehicle deleted successfully!');
            
        } catch (Exception $e) {
            $this->session->setFlashMessage('error', 'Failed to delete vehicle: ' . $e->getMessage());
        }
        
        $this->redirect('/vehicles');
    }
}
<?php
require_once __DIR__ . '/../core/BaseController.php';

class FuelController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);
        
        try {
            require_once __DIR__ . '/../models/FuelRecord.php';
            $fuelModel = new FuelRecord($this->db);
            
            // Get fuel records with vehicle and driver details
            $fuelRecords = $fuelModel->getFuelRecordsWithDetails();
            $fuelStats = $fuelModel->getFuelStats();
            
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
        
        $data = [
            'pageTitle' => 'Record Fuel - State Fleet Management System'
        ];
        
        $this->renderView('fuel/record', $data);
    }
}
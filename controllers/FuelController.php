<?php
require_once __DIR__ . '/../core/BaseController.php';

class FuelController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireRole(['super_admin', 'admin', 'data_entry_officer']);
        
        $data = [
            'pageTitle' => 'Fuel Records - State Fleet Management System',
            'fuelRecords' => [] // Will be populated when we add sample data
        ];
        
        $this->logActivity('view', 'fuel_records');
        $this->renderView('fuel/index', $data);
    }
    
    public function record() {
        $this->requireLogin();
        $this->requireRole(['super_admin', 'admin', 'data_entry_officer']);
        
        $data = [
            'pageTitle' => 'Record Fuel - State Fleet Management System'
        ];
        
        $this->renderView('fuel/record', $data);
    }
}
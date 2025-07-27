<?php
require_once __DIR__ . '/../core/BaseController.php';

class MaintenanceController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        
        $data = [
            'pageTitle' => 'Maintenance Management - State Fleet Management System'
        ];
        
        $this->logActivity('view', 'maintenance');
        $this->renderView('maintenance/index', $data);
    }
}
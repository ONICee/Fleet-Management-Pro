<?php
require_once __DIR__ . '/../core/BaseController.php';

class ReportController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireRole(['super_admin', 'admin']);
        
        $data = [
            'pageTitle' => 'Reports & Analytics - State Fleet Management System'
        ];
        
        $this->logActivity('view', 'reports');
        $this->renderView('reports/index', $data);
    }
}
<?php
require_once __DIR__ . '/../core/BaseController.php';

class NotificationController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        
        $data = [
            'pageTitle' => 'Notifications - State Fleet Management System',
            'notifications' => [] // Will be populated when we add sample data
        ];
        
        $this->logActivity('view', 'notifications');
        $this->renderView('notifications/index', $data);
    }
}
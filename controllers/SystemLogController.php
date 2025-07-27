<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/SystemLog.php';

class SystemLogController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireRole(['super_admin']);
        
        try {
            $systemLogModel = new SystemLog($this->db);
            $recentActivity = $systemLogModel->getRecentActivity(100);
            $activityStats = $systemLogModel->getActivityStats();
            
            $data = [
                'pageTitle' => 'System Logs - State Fleet Management System',
                'logs' => $recentActivity,
                'stats' => $activityStats
            ];
            
            $this->logActivity('view', 'system_logs');
            $this->renderView('system-logs/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
}
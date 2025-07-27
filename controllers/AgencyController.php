<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Agency.php';

class AgencyController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        
        $agencyModel = new Agency($this->db);
        
        try {
            // Get all agencies with vehicle counts
            $agencies = $agencyModel->getAgenciesWithVehicleCounts();
            
            // Get agency statistics
            $stats = $agencyModel->getAgencyStats();
            
            $data = [
                'pageTitle' => 'Agency Management - State Fleet Management System',
                'agencies' => $agencies,
                'stats' => $stats
            ];
            
            $this->logActivity('view', 'agencies');
            $this->renderView('agencies/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
}
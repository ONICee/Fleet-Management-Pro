<?php
require_once __DIR__ . '/../core/BaseController.php';

class ReportController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin']);
        
        try {
            require_once __DIR__ . '/../models/Vehicle.php';
            require_once __DIR__ . '/../models/FuelRecord.php';
            require_once __DIR__ . '/../models/Agency.php';
            
            $vehicleModel = new Vehicle($this->db);
            $fuelModel = new FuelRecord($this->db);
            $agencyModel = new Agency($this->db);
            
            // Get comprehensive statistics
            $fleetStats = $vehicleModel->getVehicleStats();
            $fuelStats = $fuelModel->getFuelStats();
            $agencyStats = $agencyModel->getAgencyStats();
            
            // Recent activity
            $recentFuelRecords = $fuelModel->getFuelRecordsWithDetails(10);
            $vehiclesByAgency = $agencyModel->getAgenciesWithVehicleCounts();
            
            $data = [
                'pageTitle' => 'Reports & Analytics - State Fleet Management System',
                'fleetStats' => $fleetStats,
                'fuelStats' => $fuelStats,
                'agencyStats' => $agencyStats,
                'recentFuelRecords' => $recentFuelRecords,
                'vehiclesByAgency' => $vehiclesByAgency
            ];
            
            $this->logActivity('view', 'reports');
            $this->renderView('reports/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
}
<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Agency.php';

class DashboardController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        
        $user = $this->getUser();
        $userRole = $this->getUserRole();
        
        try {
            // Get common dashboard data
            $vehicleModel = new Vehicle($this->db);
            $userModel = new User($this->db);
            $agencyModel = new Agency($this->db);
            
            // Get vehicle statistics
            $vehicleStats = $vehicleModel->getVehicleStats();
            
            // Get agency statistics
            $agencyStats = $agencyModel->getAgencyStats();
            
            // Role-specific data
            $dashboardData = [
                'vehicleStats' => $vehicleStats,
                'agencyStats' => $agencyStats,
                'userRole' => $userRole
            ];
            
            switch ($userRole) {
                case 'super_admin':
                    $dashboardData = array_merge($dashboardData, $this->getSuperAdminData());
                    break;
                    
                case 'admin':
                    $dashboardData = array_merge($dashboardData, $this->getAdminData());
                    break;
                    
                case 'data_entry_officer':
                    $dashboardData = array_merge($dashboardData, $this->getDataEntryData());
                    break;
                    
                case 'guest':
                    $dashboardData = array_merge($dashboardData, $this->getGuestData());
                    break;
            }
            
            // Log dashboard access
            $this->logActivity('view_dashboard', 'dashboard');
            
            $this->renderView('dashboard/index', $dashboardData);
            
        } catch (Exception $e) {
            $this->handleException($e, '/');
        }
    }
    
    private function getSuperAdminData() {
        $userModel = new User($this->db);
        $vehicleModel = new Vehicle($this->db);
        
        // System-wide statistics
        $userStats = $userModel->getUserStats();
        
        // Recent system activities (super admin can see all)
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                ORDER BY sl.created_at DESC
                LIMIT 10";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $recentActivities = $stmt->fetchAll();
        
        // Vehicles needing attention
        $maintenanceDue = $vehicleModel->getMaintenanceDueVehicles(30);
        
        // Critical system alerts
        $alerts = $this->getCriticalAlerts();
        
        return [
            'userStats' => $userStats,
            'recentActivities' => $recentActivities,
            'maintenanceDue' => $maintenanceDue,
            'criticalAlerts' => $alerts,
            'canManageUsers' => true,
            'canViewLogs' => true,
            'canManageSystem' => true
        ];
    }
    
    private function getAdminData() {
        $vehicleModel = new Vehicle($this->db);
        
        // Vehicle management data
        $maintenanceDue = $vehicleModel->getMaintenanceDueVehicles(30);
        
        // Recent vehicle activities
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                WHERE sl.entity_type IN ('vehicle', 'maintenance', 'fuel')
                ORDER BY sl.created_at DESC
                LIMIT 8";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $recentActivities = $stmt->fetchAll();
        
        // Fleet performance metrics
        $performanceMetrics = $this->getFleetPerformanceMetrics();
        
        return [
            'maintenanceDue' => $maintenanceDue,
            'recentActivities' => $recentActivities,
            'performanceMetrics' => $performanceMetrics,
            'canManageVehicles' => true,
            'canViewReports' => true
        ];
    }
    
    private function getDataEntryData() {
        $vehicleModel = new Vehicle($this->db);
        
        // Data entry focused information
        $recentVehicles = $vehicleModel->findAll([], 'created_at DESC', 5);
        
        // Vehicles needing updates
        $vehiclesNeedingUpdates = $this->getVehiclesNeedingUpdates();
        
        // Personal activity
        $user = $this->getUser();
        $sql = "SELECT * FROM system_logs 
                WHERE user_id = ? 
                ORDER BY created_at DESC 
                LIMIT 5";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user['id']]);
        $myActivity = $stmt->fetchAll();
        
        return [
            'recentVehicles' => $recentVehicles,
            'vehiclesNeedingUpdates' => $vehiclesNeedingUpdates,
            'myActivity' => $myActivity,
            'canCreateRecords' => true,
            'canEditRecords' => true
        ];
    }
    
    private function getGuestData() {
        $vehicleModel = new Vehicle($this->db);
        
        // Read-only information for guests
        $vehicleOverview = [
            'total' => $vehicleModel->count(),
            'serviceable' => $vehicleModel->count(['serviceability' => 'serviceable']),
            'unserviceable' => $vehicleModel->count(['serviceability' => 'unserviceable'])
        ];
        
        // Recent vehicle additions (limited info)
        $recentVehicles = $vehicleModel->findAll([], 'created_at DESC', 3);
        
        return [
            'vehicleOverview' => $vehicleOverview,
            'recentVehicles' => $recentVehicles,
            'canViewOnly' => true
        ];
    }
    
    private function getCriticalAlerts() {
        $alerts = [];
        
        // Check for overdue maintenance
        $sql = "SELECT COUNT(*) as count FROM vehicles 
                WHERE next_scheduled_maintenance < NOW() 
                AND next_scheduled_maintenance IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $overdueMaintenance = $stmt->fetch()['count'];
        
        if ($overdueMaintenance > 0) {
            $alerts[] = [
                'type' => 'danger',
                'title' => 'Overdue Maintenance',
                'message' => "$overdueMaintenance vehicles have overdue maintenance schedules",
                'action' => '/maintenance',
                'icon' => 'fas fa-exclamation-triangle'
            ];
        }
        
        // Check for inactive trackers
        $sql = "SELECT COUNT(*) as count FROM vehicles 
                WHERE tracker_status = 'inactive' OR tracker_status = 'not_installed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $inactiveTrackers = $stmt->fetch()['count'];
        
        if ($inactiveTrackers > 0) {
            $alerts[] = [
                'type' => 'warning',
                'title' => 'Tracker Issues',
                'message' => "$inactiveTrackers vehicles have inactive or missing trackers",
                'action' => '/vehicles',
                'icon' => 'fas fa-map-marker-alt'
            ];
        }
        
        // Check for expired documents
        $sql = "SELECT COUNT(*) as count FROM vehicles 
                WHERE (insurance_expiry <= DATE_ADD(NOW(), INTERVAL 30 DAY) AND insurance_expiry IS NOT NULL)
                   OR (registration_expiry <= DATE_ADD(NOW(), INTERVAL 30 DAY) AND registration_expiry IS NOT NULL)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $expiringDocs = $stmt->fetch()['count'];
        
        if ($expiringDocs > 0) {
            $alerts[] = [
                'type' => 'info',
                'title' => 'Document Expiry',
                'message' => "$expiringDocs vehicles have documents expiring within 30 days",
                'action' => '/vehicles',
                'icon' => 'fas fa-file-alt'
            ];
        }
        
        return $alerts;
    }
    
    private function getFleetPerformanceMetrics() {
        // Calculate fleet utilization, efficiency, etc.
        $metrics = [];
        
        // Vehicle utilization rate
        $sql = "SELECT 
                    COUNT(*) as total_vehicles,
                    SUM(CASE WHEN serviceability = 'serviceable' THEN 1 ELSE 0 END) as serviceable_vehicles
                FROM vehicles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        
        $utilizationRate = $result['total_vehicles'] > 0 
            ? ($result['serviceable_vehicles'] / $result['total_vehicles']) * 100 
            : 0;
        
        $metrics['utilization_rate'] = round($utilizationRate, 1);
        
        // Maintenance compliance rate
        $sql = "SELECT 
                    COUNT(*) as total_vehicles,
                    SUM(CASE WHEN next_scheduled_maintenance > NOW() OR next_scheduled_maintenance IS NULL THEN 1 ELSE 0 END) as compliant_vehicles
                FROM vehicles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        
        $complianceRate = $result['total_vehicles'] > 0 
            ? ($result['compliant_vehicles'] / $result['total_vehicles']) * 100 
            : 0;
        
        $metrics['maintenance_compliance'] = round($complianceRate, 1);
        
        // Tracker deployment rate
        $sql = "SELECT 
                    COUNT(*) as total_vehicles,
                    SUM(CASE WHEN tracker_status = 'active' THEN 1 ELSE 0 END) as tracked_vehicles
                FROM vehicles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        
        $trackerRate = $result['total_vehicles'] > 0 
            ? ($result['tracked_vehicles'] / $result['total_vehicles']) * 100 
            : 0;
        
        $metrics['tracker_deployment'] = round($trackerRate, 1);
        
        return $metrics;
    }
    
    private function getVehiclesNeedingUpdates() {
        // Find vehicles with incomplete information
        $sql = "SELECT id, vehicle_brand, vehicle_model, serial_number
                FROM vehicles 
                WHERE tracker_number IS NULL 
                   OR tracker_imei IS NULL 
                   OR engine_number IS NULL 
                   OR chassis_number IS NULL
                LIMIT 5";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
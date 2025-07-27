<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/MaintenanceSchedule.php';
require_once __DIR__ . '/../models/MaintenanceHistory.php';

class MaintenanceController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        
        try {
            $maintenanceScheduleModel = new MaintenanceSchedule($this->db);
            $maintenanceHistoryModel = new MaintenanceHistory($this->db);
            $vehicleModel = new Vehicle($this->db);
            
            // Get maintenance statistics
            $stats = $maintenanceScheduleModel->getMaintenanceStats();
            
            // Get upcoming maintenance
            $upcomingMaintenance = $maintenanceScheduleModel->getUpcomingMaintenance(20);
            
            // Get recent maintenance history
            $recentHistory = $maintenanceHistoryModel->getRecentMaintenanceHistory(20);
            
            // Get overdue maintenance
            $overdueMaintenance = $maintenanceScheduleModel->getOverdueMaintenance();
            
            // Get vehicles for scheduling
            $vehicles = $vehicleModel->getVehiclesWithDetails();
            
            $data = [
                'pageTitle' => 'Maintenance Management - State Fleet Management System',
                'stats' => $stats,
                'upcomingMaintenance' => $upcomingMaintenance,
                'recentHistory' => $recentHistory,
                'overdueMaintenance' => $overdueMaintenance,
                'vehicles' => $vehicles
            ];
            
            $this->logActivity('view', 'maintenance');
            $this->renderView('maintenance/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
    
    public function schedule() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            try {
                $data = $this->sanitizeInput($_POST);
                $maintenanceScheduleModel = new MaintenanceSchedule($this->db);
                
                $result = $maintenanceScheduleModel->createSchedule($data);
                
                if ($result['success']) {
                    $this->logActivity('create', 'maintenance_schedule', $result['id'], null, $data);
                    $this->session->setFlashMessage('success', 'Maintenance scheduled successfully!');
                } else {
                    $this->session->setFlashMessage('error', 'Failed to schedule maintenance: ' . implode(', ', $result['errors']));
                }
                
            } catch (Exception $e) {
                $this->session->setFlashMessage('error', 'Failed to schedule maintenance: ' . $e->getMessage());
            }
            
            $this->redirect('/maintenance');
        }
        
        // Show schedule form
        $vehicleModel = new Vehicle($this->db);
        $vehicles = $vehicleModel->getVehiclesWithDetails();
        
        $data = [
            'pageTitle' => 'Schedule Maintenance - State Fleet Management System',
            'vehicles' => $vehicles
        ];
        
        $this->renderView('maintenance/schedule', $data);
    }
    
    public function complete() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin', 'data_entry_officer']);
        
        $id = $this->params['id'] ?? null;
        
        if (!$id) {
            $this->session->setFlashMessage('error', 'Maintenance ID not provided');
            $this->redirect('/maintenance');
        }
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            try {
                $data = $this->sanitizeInput($_POST);
                $maintenanceScheduleModel = new MaintenanceSchedule($this->db);
                $maintenanceHistoryModel = new MaintenanceHistory($this->db);
                
                // Get the scheduled maintenance
                $schedule = $maintenanceScheduleModel->find($id);
                if (!$schedule) {
                    $this->session->setFlashMessage('error', 'Maintenance schedule not found');
                    $this->redirect('/maintenance');
                }
                
                // Create maintenance history record
                $historyData = array_merge($data, [
                    'vehicle_id' => $schedule['vehicle_id'],
                    'maintenance_schedule_id' => $id,
                    'maintenance_category' => $schedule['maintenance_category'],
                    'created_by' => $this->getUser()['id']
                ]);
                
                $historyResult = $maintenanceHistoryModel->createMaintenanceRecord($historyData);
                
                if ($historyResult['success']) {
                    // Update schedule status to completed
                    $maintenanceScheduleModel->update($id, [
                        'status' => 'completed',
                        'completed_date' => $data['maintenance_date'],
                        'actual_cost' => $data['cost'] ?? null
                    ]);
                    
                    $this->logActivity('complete', 'maintenance', $id, $schedule, $data);
                    $this->session->setFlashMessage('success', 'Maintenance completed successfully!');
                } else {
                    $this->session->setFlashMessage('error', 'Failed to complete maintenance: ' . implode(', ', $historyResult['errors']));
                }
                
            } catch (Exception $e) {
                $this->session->setFlashMessage('error', 'Failed to complete maintenance: ' . $e->getMessage());
            }
            
            $this->redirect('/maintenance');
        }
        
        // Show completion form
        $maintenanceScheduleModel = new MaintenanceSchedule($this->db);
        $schedule = $maintenanceScheduleModel->getScheduleWithVehicle($id);
        
        if (!$schedule) {
            $this->session->setFlashMessage('error', 'Maintenance schedule not found');
            $this->redirect('/maintenance');
        }
        
        $data = [
            'pageTitle' => 'Complete Maintenance - State Fleet Management System',
            'schedule' => $schedule
        ];
        
        $this->renderView('maintenance/complete', $data);
    }
}
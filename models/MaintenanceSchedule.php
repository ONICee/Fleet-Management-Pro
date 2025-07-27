<?php
require_once __DIR__ . '/BaseModel.php';

class MaintenanceSchedule extends BaseModel {
    
    public function __construct($db) {
        parent::__construct($db, 'maintenance_schedules');
    }
    
    public function createSchedule($data) {
        $errors = [];
        
        // Validate required fields
        if (empty($data['vehicle_id'])) {
            $errors['vehicle_id'] = 'Vehicle is required';
        }
        if (empty($data['maintenance_category'])) {
            $errors['maintenance_category'] = 'Maintenance category is required';
        }
        if (empty($data['maintenance_type'])) {
            $errors['maintenance_type'] = 'Maintenance type is required';
        }
        if (empty($data['description'])) {
            $errors['description'] = 'Description is required';
        }
        if (empty($data['scheduled_date'])) {
            $errors['scheduled_date'] = 'Scheduled date is required';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        // Set defaults
        $data['status'] = $data['status'] ?? 'scheduled';
        $data['priority'] = $data['priority'] ?? 'normal';
        $data['authorized_by'] = $data['authorized_by'] ?? null;
        
        $scheduleId = $this->create($data);
        
        if ($scheduleId) {
            return ['success' => true, 'id' => $scheduleId];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to create maintenance schedule']];
    }
    
    public function getMaintenanceStats() {
        $stats = [];
        
        // Total scheduled maintenance
        $sql = "SELECT COUNT(*) as total FROM maintenance_schedules WHERE status != 'cancelled'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['total'] = $stmt->fetchColumn();
        
        // Upcoming maintenance (next 30 days)
        $sql = "SELECT COUNT(*) as upcoming FROM maintenance_schedules 
                WHERE status = 'scheduled' 
                AND scheduled_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['upcoming'] = $stmt->fetchColumn();
        
        // Overdue maintenance
        $sql = "SELECT COUNT(*) as overdue FROM maintenance_schedules 
                WHERE status = 'scheduled' AND scheduled_date < CURDATE()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['overdue'] = $stmt->fetchColumn();
        
        // In progress maintenance
        $sql = "SELECT COUNT(*) as in_progress FROM maintenance_schedules WHERE status = 'in_progress'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['in_progress'] = $stmt->fetchColumn();
        
        // Completed this month
        $sql = "SELECT COUNT(*) as completed_month FROM maintenance_schedules 
                WHERE status = 'completed' 
                AND MONTH(completed_date) = MONTH(CURDATE()) 
                AND YEAR(completed_date) = YEAR(CURDATE())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['completed_month'] = $stmt->fetchColumn();
        
        // Total cost this month
        $sql = "SELECT COALESCE(SUM(actual_cost), 0) as monthly_cost FROM maintenance_schedules 
                WHERE status = 'completed' 
                AND MONTH(completed_date) = MONTH(CURDATE()) 
                AND YEAR(completed_date) = YEAR(CURDATE())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['monthly_cost'] = $stmt->fetchColumn();
        
        return $stats;
    }
    
    public function getUpcomingMaintenance($limit = 20) {
        $sql = "SELECT ms.*, v.vehicle_brand, v.vehicle_model, v.serial_number, v.license_plate,
                       a.agency_name, a.agency_code
                FROM maintenance_schedules ms
                JOIN vehicles v ON ms.vehicle_id = v.id
                LEFT JOIN agencies a ON v.agency_id = a.id
                WHERE ms.status = 'scheduled'
                ORDER BY ms.scheduled_date ASC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOverdueMaintenance() {
        $sql = "SELECT ms.*, v.vehicle_brand, v.vehicle_model, v.serial_number, v.license_plate,
                       a.agency_name, a.agency_code,
                       DATEDIFF(CURDATE(), ms.scheduled_date) as days_overdue
                FROM maintenance_schedules ms
                JOIN vehicles v ON ms.vehicle_id = v.id
                LEFT JOIN agencies a ON v.agency_id = a.id
                WHERE ms.status = 'scheduled' AND ms.scheduled_date < CURDATE()
                ORDER BY ms.scheduled_date ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getScheduleWithVehicle($id) {
        $sql = "SELECT ms.*, v.vehicle_brand, v.vehicle_model, v.serial_number, v.license_plate,
                       a.agency_name, a.agency_code
                FROM maintenance_schedules ms
                JOIN vehicles v ON ms.vehicle_id = v.id
                LEFT JOIN agencies a ON v.agency_id = a.id
                WHERE ms.id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getVehicleMaintenanceSchedules($vehicleId) {
        $sql = "SELECT * FROM maintenance_schedules 
                WHERE vehicle_id = ? 
                ORDER BY scheduled_date DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateSchedule($id, $data) {
        return $this->update($id, $data);
    }
}
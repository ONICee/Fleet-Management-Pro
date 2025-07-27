<?php
require_once __DIR__ . '/BaseModel.php';

class MaintenanceHistory extends BaseModel {
    
    public function __construct($db) {
        parent::__construct($db, 'maintenance_history');
    }
    
    public function createMaintenanceRecord($data) {
        $errors = [];
        
        // Validate required fields
        if (empty($data['vehicle_id'])) {
            $errors['vehicle_id'] = 'Vehicle is required';
        }
        if (empty($data['maintenance_date'])) {
            $errors['maintenance_date'] = 'Maintenance date is required';
        }
        if (empty($data['maintenance_category'])) {
            $errors['maintenance_category'] = 'Maintenance category is required';
        }
        if (empty($data['work_performed'])) {
            $errors['work_performed'] = 'Work performed description is required';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        // Set defaults
        $data['created_by'] = $data['created_by'] ?? null;
        
        $recordId = $this->create($data);
        
        if ($recordId) {
            return ['success' => true, 'id' => $recordId];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to create maintenance record']];
    }
    
    public function getRecentMaintenanceHistory($limit = 20) {
        $sql = "SELECT mh.*, v.vehicle_brand, v.vehicle_model, v.serial_number, v.license_plate,
                       a.agency_name, a.agency_code,
                       CONCAT(u.first_name, ' ', u.last_name) as created_by_name
                FROM maintenance_history mh
                JOIN vehicles v ON mh.vehicle_id = v.id
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN users u ON mh.created_by = u.id
                ORDER BY mh.maintenance_date DESC, mh.created_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getVehicleMaintenanceHistory($vehicleId, $limit = null) {
        $sql = "SELECT mh.*, 
                       CONCAT(u.first_name, ' ', u.last_name) as created_by_name
                FROM maintenance_history mh
                LEFT JOIN users u ON mh.created_by = u.id
                WHERE mh.vehicle_id = ?
                ORDER BY mh.maintenance_date DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMaintenanceHistoryStats($vehicleId = null) {
        $stats = [];
        $whereClause = $vehicleId ? "WHERE vehicle_id = ?" : "";
        $params = $vehicleId ? [$vehicleId] : [];
        
        // Total maintenance records
        $sql = "SELECT COUNT(*) as total FROM maintenance_history {$whereClause}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $stats['total'] = $stmt->fetchColumn();
        
        // Total cost
        $sql = "SELECT COALESCE(SUM(cost), 0) as total_cost FROM maintenance_history {$whereClause}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $stats['total_cost'] = $stmt->fetchColumn();
        
        // This year's cost
        $yearParams = $vehicleId ? [$vehicleId] : [];
        $yearWhere = $vehicleId ? "WHERE vehicle_id = ? AND" : "WHERE";
        $sql = "SELECT COALESCE(SUM(cost), 0) as year_cost 
                FROM maintenance_history 
                {$yearWhere} YEAR(maintenance_date) = YEAR(CURDATE())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($yearParams);
        $stats['year_cost'] = $stmt->fetchColumn();
        
        // Maintenance by category
        $sql = "SELECT maintenance_category, COUNT(*) as count, COALESCE(SUM(cost), 0) as cost
                FROM maintenance_history 
                {$whereClause}
                GROUP BY maintenance_category";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $stats['by_category'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $stats;
    }
    
    public function getMaintenanceByDateRange($startDate, $endDate, $vehicleId = null) {
        $whereClause = "WHERE maintenance_date BETWEEN ? AND ?";
        $params = [$startDate, $endDate];
        
        if ($vehicleId) {
            $whereClause .= " AND vehicle_id = ?";
            $params[] = $vehicleId;
        }
        
        $sql = "SELECT mh.*, v.vehicle_brand, v.vehicle_model, v.serial_number,
                       a.agency_name, a.agency_code
                FROM maintenance_history mh
                JOIN vehicles v ON mh.vehicle_id = v.id
                LEFT JOIN agencies a ON v.agency_id = a.id
                {$whereClause}
                ORDER BY mh.maintenance_date DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLastMaintenanceByCategory($vehicleId, $category) {
        $sql = "SELECT * FROM maintenance_history 
                WHERE vehicle_id = ? AND maintenance_category = ?
                ORDER BY maintenance_date DESC 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$vehicleId, $category]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateMaintenanceRecord($id, $data) {
        return $this->update($id, $data);
    }
}
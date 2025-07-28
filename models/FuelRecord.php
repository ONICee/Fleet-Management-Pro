<?php
require_once __DIR__ . '/BaseModel.php';

class FuelRecord extends BaseModel {
    
    public function __construct($db) {
        parent::__construct($db, 'fuel_records');
    }
    
    public function getFuelRecordsWithDetails($limit = 100) {
        $sql = "SELECT 
                    fr.*,
                    v.vehicle_brand,
                    v.vehicle_model, 
                    v.serial_number,
                    v.license_plate,
                    CONCAT(u.first_name, ' ', u.last_name) as driver_name,
                    u.username as driver_username
                FROM fuel_records fr
                LEFT JOIN vehicles v ON fr.vehicle_id = v.id
                LEFT JOIN drivers d ON fr.driver_id = d.id
                LEFT JOIN users u ON d.user_id = u.id
                ORDER BY fr.fuel_date DESC, fr.created_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFuelStats() {
        $stats = [];
        
        // Total records
        $sql = "SELECT COUNT(*) as total FROM fuel_records";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['total_records'] = $stmt->fetchColumn();
        
        // Total cost this month
        $sql = "SELECT COALESCE(SUM(total_cost), 0) as total_cost 
                FROM fuel_records 
                WHERE MONTH(fuel_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(fuel_date) = YEAR(CURRENT_DATE())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['monthly_cost'] = $stmt->fetchColumn();
        
        // Total quantity this month
        $sql = "SELECT COALESCE(SUM(quantity), 0) as total_quantity 
                FROM fuel_records 
                WHERE MONTH(fuel_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(fuel_date) = YEAR(CURRENT_DATE())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['monthly_quantity'] = $stmt->fetchColumn();
        
        // Average price per liter
        $sql = "SELECT COALESCE(AVG(price_per_unit), 0) as avg_price 
                FROM fuel_records 
                WHERE fuel_date >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['avg_price'] = $stmt->fetchColumn();
        
        return $stats;
    }
    
    public function createFuelRecord($data) {
        $sql = "INSERT INTO fuel_records (
                    vehicle_id, driver_id, fuel_station, fuel_type, quantity, 
                    price_per_unit, total_cost, mileage_at_fillup, receipt_number, 
                    fuel_date, location
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['vehicle_id'],
            $data['driver_id'] ?? null,
            $data['fuel_station'],
            $data['fuel_type'],
            $data['quantity'],
            $data['price_per_unit'],
            $data['total_cost'],
            $data['mileage_at_fillup'] ?? null,
            $data['receipt_number'] ?? null,
            $data['fuel_date'],
            $data['location'] ?? null
        ]);
        
        return $this->db->lastInsertId();
    }
}
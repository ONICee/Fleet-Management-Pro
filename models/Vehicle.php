<?php
require_once __DIR__ . '/BaseModel.php';

class Vehicle extends BaseModel {
    protected $table = 'vehicles';
    protected $fillable = [
        'vehicle_brand', 'vehicle_model', 'serial_number', 'year_allotted', 'year_manufactured',
        'vehicle_type', 'fuel_type', 'engine_number', 'chassis_number', 'license_plate', 'vin',
        'tracker_number', 'tracker_imei', 'tracker_status', 'agency_id', 'deployment_location_id',
        'serviceability', 'current_condition', 'current_mileage', 'purchase_date', 'purchase_price',
        'supplier', 'last_overhaul', 'next_overhaul', 'last_scheduled_maintenance', 
        'next_scheduled_maintenance', 'insurance_policy', 'insurance_expiry', 'registration_expiry',
        // Live location fields (added 2025-07-28)
        'current_lat', 'current_lng', 'last_fix_at'
    ];
    
    public function createVehicle($data) {
        // Validate required fields according to state specifications
        $rules = [
            'vehicle_brand' => 'required|max:50',
            'vehicle_model' => 'required|max:50',
            'serial_number' => 'required|max:30',
            'year_allotted' => 'required|numeric',
            'vehicle_type' => 'required',
            'fuel_type' => 'required',
            'agency_id' => 'required|numeric',
            'deployment_location_id' => 'required|numeric'
        ];
        
        $errors = $this->validate($data, $rules);
        
        // Check for unique serial number
        if ($this->findBy('serial_number', $data['serial_number'])) {
            $errors['serial_number'] = 'Serial number already exists';
        }
        
        // Check for unique license plate if provided
        if (!empty($data['license_plate']) && $this->findBy('license_plate', $data['license_plate'])) {
            $errors['license_plate'] = 'License plate already exists';
        }
        
        // Check for unique VIN if provided
        if (!empty($data['vin']) && $this->findBy('vin', $data['vin'])) {
            $errors['vin'] = 'VIN already exists';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        // Set default values
        if (empty($data['serviceability'])) {
            $data['serviceability'] = 'serviceable';
        }
        
        if (empty($data['tracker_status'])) {
            $data['tracker_status'] = 'not_installed';
        }
        
        $vehicleId = $this->create($data);
        
        if ($vehicleId) {
            return ['success' => true, 'vehicle_id' => $vehicleId];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to create vehicle']];
    }
    
    public function updateVehicle($id, $data) {
        $rules = [
            'vehicle_brand' => 'max:50',
            'vehicle_model' => 'max:50',
            'serial_number' => 'max:30',
            'year_allotted' => 'numeric',
            'agency_id' => 'numeric',
            'deployment_location_id' => 'numeric'
        ];
        
        $errors = $this->validate($data, $rules);
        
        // Check for unique values (excluding current vehicle)
        if (!empty($data['serial_number'])) {
            $existing = $this->findBy('serial_number', $data['serial_number']);
            if ($existing && $existing['id'] != $id) {
                $errors['serial_number'] = 'Serial number already exists';
            }
        }
        
        if (!empty($data['license_plate'])) {
            $existing = $this->findBy('license_plate', $data['license_plate']);
            if ($existing && $existing['id'] != $id) {
                $errors['license_plate'] = 'License plate already exists';
            }
        }
        
        if (!empty($data['vin'])) {
            $existing = $this->findBy('vin', $data['vin']);
            if ($existing && $existing['id'] != $id) {
                $errors['vin'] = 'VIN already exists';
            }
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        $result = $this->update($id, $data);
        
        if ($result) {
            return ['success' => true];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to update vehicle']];
    }
    
    public function getVehiclesWithDetails($conditions = [], $orderBy = 'v.created_at DESC') {
        $sql = "SELECT v.*, a.agency_name, a.agency_code, a.agency_type,
                       dl.location_name, dl.local_government, dl.senatorial_zone
                FROM vehicles v
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id";
        
        $params = [];
        $whereClause = [];
        
        if (!empty($conditions)) {
            foreach ($conditions as $column => $value) {
                if ($column === 'search') {
                    // Search across multiple fields
                    $whereClause[] = "(v.vehicle_brand LIKE ? OR v.vehicle_model LIKE ? OR v.serial_number LIKE ? OR v.license_plate LIKE ?)";
                    $searchValue = '%' . $value . '%';
                    $params[] = $searchValue;
                    $params[] = $searchValue;
                    $params[] = $searchValue;
                    $params[] = $searchValue;
                } else {
                    $whereClause[] = "v.{$column} = ?";
                    $params[] = $value;
                }
            }
        }
        
        if (!empty($whereClause)) {
            $sql .= " WHERE " . implode(' AND ', $whereClause);
        }
        
        if ($orderBy) {
            $sql .= " ORDER BY " . $orderBy;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function getVehicleWithDetails($id) {
        $sql = "SELECT v.*, a.agency_name, a.agency_code, a.agency_type,
                       dl.location_name, dl.local_government, dl.senatorial_zone, dl.state_zone
                FROM vehicles v
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id
                WHERE v.id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function searchVehicles($searchTerm) {
        $sql = "SELECT v.*, a.agency_name, dl.location_name
                FROM vehicles v
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id
                WHERE v.vehicle_brand LIKE ? OR v.vehicle_model LIKE ? OR v.serial_number LIKE ?
                   OR v.license_plate LIKE ? OR a.agency_name LIKE ? OR dl.location_name LIKE ?";
        
        $searchParam = "%{$searchTerm}%";
        $params = array_fill(0, 6, $searchParam);
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function getVehiclesByAgency($agencyId) {
        return $this->getVehiclesWithDetails(['agency_id' => $agencyId]);
    }
    
    public function getVehiclesByLocation($locationId) {
        return $this->getVehiclesWithDetails(['deployment_location_id' => $locationId]);
    }
    
    public function getVehiclesByServiceability($serviceability) {
        return $this->getVehiclesWithDetails(['serviceability' => $serviceability]);
    }
    
    public function getVehiclesByTrackerStatus($trackerStatus) {
        return $this->getVehiclesWithDetails(['tracker_status' => $trackerStatus]);
    }
    
    public function getVehicleStats() {
        $stats = [];
        
        // Total vehicles
        $stats['total_vehicles'] = $this->count();
        
        // By serviceability
        $stats['serviceable'] = $this->count(['serviceability' => 'serviceable']);
        $stats['unserviceable'] = $this->count(['serviceability' => 'unserviceable']);
        
        // By tracker status
        $stats['tracker_active'] = $this->count(['tracker_status' => 'active']);
        $stats['tracker_inactive'] = $this->count(['tracker_status' => 'inactive']);
        $stats['tracker_not_installed'] = $this->count(['tracker_status' => 'not_installed']);
        
        // By vehicle type
        $vehicleTypes = ['land', 'air', 'sea', 'drone', 'motorcycle', 'truck', 'van', 'car', 'bus', 'boat', 'helicopter', 'other'];
        foreach ($vehicleTypes as $type) {
            $stats['type_' . $type] = $this->count(['vehicle_type' => $type]);
        }
        
        // By brand (top 5)
        $sql = "SELECT vehicle_brand, COUNT(*) as count FROM vehicles GROUP BY vehicle_brand ORDER BY count DESC LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['top_brands'] = $stmt->fetchAll();
        
        // Maintenance due (next 30 days)
        $sql = "SELECT COUNT(*) as count FROM vehicles WHERE next_scheduled_maintenance <= DATE_ADD(NOW(), INTERVAL 30 DAY) AND next_scheduled_maintenance IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $stats['maintenance_due_soon'] = $result['count'];
        
        // Overhaul due (next 60 days)
        $sql = "SELECT COUNT(*) as count FROM vehicles WHERE next_overhaul <= DATE_ADD(NOW(), INTERVAL 60 DAY) AND next_overhaul IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $stats['overhaul_due_soon'] = $result['count'];
        
        return $stats;
    }
    
    public function getVehiclesByBrand($brand) {
        return $this->getVehiclesWithDetails(['vehicle_brand' => $brand]);
    }
    
    public function getVehiclesBySenatoralZone($zone) {
        $sql = "SELECT v.*, a.agency_name, dl.location_name, dl.senatorial_zone
                FROM vehicles v
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id
                WHERE dl.senatorial_zone = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$zone]);
        return $stmt->fetchAll();
    }
    
    public function getMaintenanceDueVehicles($days = 30) {
        $sql = "SELECT v.*, a.agency_name, dl.location_name
                FROM vehicles v
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id
                WHERE v.next_scheduled_maintenance <= DATE_ADD(NOW(), INTERVAL ? DAY)
                   OR v.next_overhaul <= DATE_ADD(NOW(), INTERVAL ? DAY)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$days, $days]);
        return $stmt->fetchAll();
    }
    
    public function updateMaintenanceDates($vehicleId, $maintenanceType, $completedDate, $nextDate = null) {
        $data = [];
        
        if ($maintenanceType === 'scheduled') {
            $data['last_scheduled_maintenance'] = $completedDate;
            if ($nextDate) {
                $data['next_scheduled_maintenance'] = $nextDate;
            }
        } elseif ($maintenanceType === 'overhaul') {
            $data['last_overhaul'] = $completedDate;
            if ($nextDate) {
                $data['next_overhaul'] = $nextDate;
            }
        }
        
        return $this->update($vehicleId, $data);
    }

    /**
     * Update the live GPS location of a vehicle. Returns bool success.
     */
    public function updateLocation($vehicleId, $lat, $lng, $fixTime = null) {
        $data = [
            'current_lat' => $lat,
            'current_lng' => $lng,
            'last_fix_at' => $fixTime ?: date('Y-m-d H:i:s')
        ];
        return $this->update($vehicleId, $data);
    }
    
    public function getVehiclesWithPagination($page = 1, $perPage = 10, $filters = []) {
        $offset = ($page - 1) * $perPage;
        
        $sql = "SELECT v.*, a.agency_name, dl.location_name
                FROM vehicles v
                LEFT JOIN agencies a ON v.agency_id = a.id
                LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id";
        
        $countSql = "SELECT COUNT(*) as total
                     FROM vehicles v
                     LEFT JOIN agencies a ON v.agency_id = a.id
                     LEFT JOIN deployment_locations dl ON v.deployment_location_id = dl.id";
        
        $whereClause = [];
        $params = [];
        
        if (!empty($filters['agency_id'])) {
            $whereClause[] = "v.agency_id = ?";
            $params[] = $filters['agency_id'];
        }
        
        if (!empty($filters['serviceability'])) {
            $whereClause[] = "v.serviceability = ?";
            $params[] = $filters['serviceability'];
        }
        
        if (!empty($filters['vehicle_type'])) {
            $whereClause[] = "v.vehicle_type = ?";
            $params[] = $filters['vehicle_type'];
        }
        
        if (!empty($filters['tracker_status'])) {
            $whereClause[] = "v.tracker_status = ?";
            $params[] = $filters['tracker_status'];
        }
        
        if (!empty($filters['search'])) {
            $whereClause[] = "(v.vehicle_brand LIKE ? OR v.vehicle_model LIKE ? OR v.serial_number LIKE ? OR v.license_plate LIKE ?)";
            $searchParam = "%{$filters['search']}%";
            $params = array_merge($params, [$searchParam, $searchParam, $searchParam, $searchParam]);
        }
        
        if (!empty($whereClause)) {
            $whereStr = " WHERE " . implode(' AND ', $whereClause);
            $sql .= $whereStr;
            $countSql .= $whereStr;
        }
        
        // Count total records
        $stmt = $this->db->prepare($countSql);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        
        // Get paginated results
        $sql .= " ORDER BY v.created_at DESC LIMIT {$offset}, {$perPage}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll();
        
        return [
            'data' => $results,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total_records' => $total,
                'total_pages' => ceil($total / $perPage),
                'has_previous' => $page > 1,
                'has_next' => $page < ceil($total / $perPage)
            ]
        ];
    }
    
    public function getMaintenanceHistory($vehicleId) {
        $sql = "SELECT mh.*, ms.maintenance_category, ms.maintenance_type
                FROM maintenance_history mh
                LEFT JOIN maintenance_schedules ms ON mh.maintenance_schedule_id = ms.id
                WHERE mh.vehicle_id = ?
                ORDER BY mh.maintenance_date DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$vehicleId]);
        return $stmt->fetchAll();
    }
}
?>
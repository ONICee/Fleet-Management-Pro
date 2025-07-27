<?php
require_once __DIR__ . '/BaseModel.php';

class Agency extends BaseModel {
    protected $table = 'agencies';
    protected $fillable = [
        'agency_name', 'agency_code', 'agency_type', 'contact_person',
        'contact_phone', 'contact_email', 'headquarters_address'
    ];
    
    public function createAgency($data) {
        $rules = [
            'agency_name' => 'required|max:100',
            'agency_code' => 'required|max:20',
            'agency_type' => 'required'
        ];
        
        $errors = $this->validate($data, $rules);
        
        // Check for unique agency code
        if ($this->findBy('agency_code', $data['agency_code'])) {
            $errors['agency_code'] = 'Agency code already exists';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        $agencyId = $this->create($data);
        
        if ($agencyId) {
            return ['success' => true, 'agency_id' => $agencyId];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to create agency']];
    }
    
    public function updateAgency($id, $data) {
        $rules = [
            'agency_name' => 'max:100',
            'agency_code' => 'max:20',
            'contact_email' => 'email'
        ];
        
        $errors = $this->validate($data, $rules);
        
        // Check for unique agency code (excluding current agency)
        if (!empty($data['agency_code'])) {
            $existing = $this->findBy('agency_code', $data['agency_code']);
            if ($existing && $existing['id'] != $id) {
                $errors['agency_code'] = 'Agency code already exists';
            }
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        $result = $this->update($id, $data);
        
        if ($result) {
            return ['success' => true];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to update agency']];
    }
    
    public function getAgenciesByType($type) {
        return $this->findAll(['agency_type' => $type], 'agency_name ASC');
    }
    
    public function searchAgencies($searchTerm) {
        return $this->search($searchTerm, ['agency_name', 'agency_code', 'contact_person']);
    }
    
    public function getAgencyWithVehicleCount($id) {
        $sql = "SELECT a.*, COUNT(v.id) as vehicle_count
                FROM agencies a
                LEFT JOIN vehicles v ON a.id = v.agency_id
                WHERE a.id = ?
                GROUP BY a.id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getAgenciesWithVehicleCounts() {
        $sql = "SELECT a.*, COUNT(v.id) as vehicle_count
                FROM agencies a
                LEFT JOIN vehicles v ON a.id = v.agency_id
                GROUP BY a.id
                ORDER BY a.agency_name ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAgencyStats() {
        $stats = [];
        
        // Total agencies by type
        $stats['federal'] = $this->count(['agency_type' => 'federal']);
        $stats['state'] = $this->count(['agency_type' => 'state']);
        $stats['local'] = $this->count(['agency_type' => 'local']);
        $stats['total'] = $this->count();
        
        return $stats;
    }
}
?>
<?php
require_once __DIR__ . '/BaseModel.php';

class DeploymentLocation extends BaseModel {
    
    public function __construct($db) {
        parent::__construct($db, 'deployment_locations');
    }
    
    public function findAll() {
        $sql = "SELECT * FROM deployment_locations ORDER BY location_name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLocationsByZone($zone = null) {
        if ($zone) {
            $sql = "SELECT * FROM deployment_locations WHERE senatorial_zone = ? ORDER BY location_name";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$zone]);
        } else {
            $sql = "SELECT * FROM deployment_locations ORDER BY senatorial_zone, location_name";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
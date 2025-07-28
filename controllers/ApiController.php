<?php
require_once __DIR__ . '/../core/BaseController.php';

class ApiController extends BaseController {
    public function getUnreadNotifications() {
        $this->renderAPI(['unread' => 0]);
    }
    public function getVehicleStatus() {
        require_once __DIR__ . '/../models/Vehicle.php';
        require_once __DIR__ . '/../models/Setting.php';

        $setting = new Setting($this->db);
        if ($setting->get('tracker_api_enabled','0') !== '1') {
            $this->renderAPI(['message' => 'Tracker API disabled'], 403);
        }

        $vehicleModel = new Vehicle($this->db);
        if (isset($_GET['id'])) {
            $vehicle = $vehicleModel->getVehicleWithDetails($_GET['id']);
            if (!$vehicle) {
                $this->renderAPI(['message'=>'Not found'],404);
            }
            $this->renderAPI(['vehicle' => $vehicle]);
        } else {
            $vehicles = $vehicleModel->getVehiclesWithDetails();
            $this->renderAPI(['vehicles' => $vehicles]);
        }
    }
    public function getActiveTrips() {
        $this->renderAPI(['active_trips' => []]);
    }
    public function getDashboardStats() {
        $this->renderAPI(['stats' => []]);
    }
}
?>
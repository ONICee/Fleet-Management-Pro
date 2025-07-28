<?php
require_once __DIR__ . '/../core/BaseController.php';

class ApiController extends BaseController {
    public function getUnreadNotifications() {
        $this->renderAPI(['unread' => 0]);
    }
    public function getVehicleStatus() {
        $this->renderAPI(['vehicles' => []]);
    }
    public function getActiveTrips() {
        $this->renderAPI(['active_trips' => []]);
    }
    public function getDashboardStats() {
        $this->renderAPI(['stats' => []]);
    }
}
?>
<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Driver.php';

class DriverController extends BaseController {
    public function index() {
        $this->requireLogin();
        $driverModel = new Driver($this->db);
        $drivers = $driverModel->findAll();
        $data = [
            'pageTitle' => 'Driver Management - State Fleet Management System',
            'drivers'   => $drivers
        ];
        $this->renderView('drivers/index', $data);
    }

    // Placeholder methods to satisfy routes; they currently redirect back with a flash message.
    private function notImplemented() {
        $this->session->setFlashMessage('warning', 'This functionality is coming soon.');
        $this->redirect('/drivers');
    }
    public function create() { $this->requireLogin(); $this->notImplemented(); }
    public function edit()   { $this->requireLogin(); $this->notImplemented(); }
    public function delete() { $this->requireLogin(); $this->notImplemented(); }
    public function view()   { $this->requireLogin(); $this->notImplemented(); }
}
?>
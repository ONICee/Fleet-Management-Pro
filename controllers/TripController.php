<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Trip.php';

class TripController extends BaseController {
    public function index() {
        $this->requireLogin();
        $tripModel = new Trip($this->db);
        $trips = $tripModel->findAll();
        $data = [
            'pageTitle' => 'Trip Management - State Fleet Management System',
            'trips'     => $trips
        ];
        $this->renderView('trips/index', $data);
    }
    private function notImplemented() {
        $this->session->setFlashMessage('warning', 'Feature coming soon.');
        $this->redirect('/trips');
    }
    public function create() { $this->requireLogin(); $this->notImplemented(); }
    public function edit()   { $this->requireLogin(); $this->notImplemented(); }
    public function view()   { $this->requireLogin(); $this->notImplemented(); }
    public function start()  { $this->requireLogin(); $this->notImplemented(); }
    public function complete(){ $this->requireLogin(); $this->notImplemented(); }
}
?>
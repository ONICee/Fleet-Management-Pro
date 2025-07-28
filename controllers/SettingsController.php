<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Setting.php';

class SettingsController extends BaseController {
    public function index() {
        $this->requireRole('super_admin');
        $settingModel = new Setting($this->db);
        $trackerEnabled = $settingModel->get('tracker_api_enabled', '0');
        $trackerUrl     = $settingModel->get('tracker_api_url', '');
        $trackerToken   = $settingModel->get('tracker_api_token', '');
        $data = [
            'pageTitle'       => 'System Settings - State Fleet Management System',
            'trackerEnabled'  => $trackerEnabled,
            'trackerUrl'      => $trackerUrl,
            'trackerToken'    => $trackerToken
        ];
        $this->renderView('settings/index', $data);
    }
    public function update() {
        $this->requireRole('super_admin');
        if (!$this->isPost()) { $this->redirect('/settings'); }
        $this->validateCSRF();
        $data = $this->sanitizeInput($_POST);
        $settingModel = new Setting($this->db);
        $settingModel->set('tracker_api_enabled', isset($data['tracker_enabled']) ? '1' : '0');
        $settingModel->set('tracker_api_url', $data['tracker_url'] ?? '');
        $settingModel->set('tracker_api_token', $data['tracker_token'] ?? '');
        $this->session->setFlashMessage('success','Settings updated');
        $this->redirect('/settings');
    }
}
?>
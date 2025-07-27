<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php';

class UserController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireRole(['super_admin']);
        
        try {
            $userModel = new User($this->db);
            $users = $userModel->findAll();
            $stats = $userModel->getUserStats();
            
            $data = [
                'pageTitle' => 'User Management - State Fleet Management System',
                'users' => $users,
                'stats' => $stats
            ];
            
            $this->logActivity('view', 'users');
            $this->renderView('users/index', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/dashboard');
        }
    }
    
    public function profile() {
        $this->requireLogin();
        
        $user = $this->getUser();
        
        $data = [
            'pageTitle' => 'My Profile - State Fleet Management System',
            'user' => $user
        ];
        
        $this->logActivity('view', 'profile');
        $this->renderView('users/profile', $data);
    }
    
    public function create() {
        $this->requireLogin();
        $this->requireRole(['super_admin']);
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            $data = $this->sanitizeInput($_POST);
            
            try {
                $userModel = new User($this->db);
                $userId = $userModel->createUser($data);
                
                $this->logActivity('create', 'user', $userId, null, $data);
                $this->session->setFlashMessage('success', 'User created successfully!');
                $this->redirect('/users');
                
            } catch (Exception $e) {
                $this->session->setFlashMessage('error', 'Failed to create user: ' . $e->getMessage());
            }
        }
        
        $data = [
            'pageTitle' => 'Create User - State Fleet Management System'
        ];
        
        $this->renderView('users/create', $data);
    }
}
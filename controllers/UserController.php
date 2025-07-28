<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php';

class UserController extends BaseController {
    
    public function index() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin']);
        
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
        $this->requireAnyRole(['super_admin', 'admin']);
        
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
    
    public function edit() {
        $this->requireLogin();
        
        $id = $this->params['id'] ?? null;
        $currentUser = $this->getUser();
        
        // Users can edit their own profile, super admins can edit any profile
        if ($currentUser['id'] != $id && $currentUser['role'] !== 'super_admin') {
            $this->session->setFlashMessage('error', 'You can only edit your own profile.');
            $this->redirect('/users/profile');
        }
        
        if (!$id) {
            $this->session->setFlashMessage('error', 'User ID not provided');
            $this->redirect('/users');
        }
        
        try {
            $userModel = new User($this->db);
            $user = $userModel->find($id);
            
            if (!$user) {
                $this->session->setFlashMessage('error', 'User not found');
                $this->redirect('/users');
            }
            
            if ($this->isPost()) {
                $this->validateCSRF();
                
                $data = $this->sanitizeInput($_POST);
                
                // Remove password fields if empty
                if (empty($data['password'])) {
                    unset($data['password']);
                    unset($data['confirm_password']);
                } else {
                    // Validate password confirmation
                    if ($data['password'] !== $data['confirm_password']) {
                        $this->session->setFlashMessage('error', 'Passwords do not match');
                        $this->redirect('/users/edit/' . $id);
                    }
                    $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
                    unset($data['password'], $data['confirm_password']);
                }
                
                $userModel->updateUser($id, $data);
                
                $this->logActivity('update', 'user', $id, $user, $data);
                $this->session->setFlashMessage('success', 'Profile updated successfully!');
                
                if ($currentUser['id'] == $id) {
                    $this->redirect('/users/profile');
                } else {
                    $this->redirect('/users');
                }
            }
            
            $data = [
                'pageTitle' => 'Edit Profile - State Fleet Management System',
                'user' => $user,
                'isOwnProfile' => ($currentUser['id'] == $id)
            ];
            
            $this->renderView('users/edit', $data);
            
        } catch (Exception $e) {
            $this->handleException($e, '/users');
        }
    }
    
    public function delete() {
        $this->requireLogin();
        $this->requireAnyRole(['super_admin', 'admin']);
        
        if (!$this->isPost()) {
            $this->session->setFlashMessage('error', 'Invalid request method');
            $this->redirect('/users');
        }
        
        $this->validateCSRF();
        
        $id = $this->params['id'] ?? null;
        $currentUser = $this->getUser();
        
        if (!$id) {
            $this->session->setFlashMessage('error', 'User ID not provided');
            $this->redirect('/users');
        }
        
        // Prevent self-deletion
        if ($currentUser['id'] == $id) {
            $this->session->setFlashMessage('error', 'You cannot delete your own account');
            $this->redirect('/users');
        }
        
        try {
            $userModel = new User($this->db);
            $user = $userModel->find($id);
            
            if (!$user) {
                $this->session->setFlashMessage('error', 'User not found');
                $this->redirect('/users');
            }
            
            // Admin cannot delete super admin
            if ($currentUser['role'] === 'admin' && $user['role'] === 'super_admin') {
                $this->session->setFlashMessage('error', 'Administrators cannot delete Super Administrators');
                $this->redirect('/users');
            }
            
            $userModel->delete($id);
            
            $this->logActivity('delete', 'user', $id, $user);
            $this->session->setFlashMessage('success', 'User deleted successfully!');
            
        } catch (Exception $e) {
            $this->session->setFlashMessage('error', 'Failed to delete user: ' . $e->getMessage());
        }
        
        $this->redirect('/users');
    }
}
<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends BaseController {
    
    public function login() {
        // Redirect if already logged in
        if ($this->session->isLoggedIn()) {
            $this->redirect('/dashboard');
        }
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            $username = $this->sanitizeInput($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                $this->session->setFlashMessage('error', 'Please enter both username and password');
                $this->redirect('/login');
            }
            
            try {
                $userModel = new User($this->db);
                $user = $userModel->authenticate($username, $password);
                
                if ($user) {
                    $this->session->setUser($user);
                    
                    // Log successful login
                    $this->logActivity('login', 'user', $user['id']);
                    
                    $this->session->setFlashMessage('success', 'Welcome back, ' . $user['first_name'] . '!');
                    $this->redirect('/dashboard');
                } else {
                    $this->session->setFlashMessage('error', 'Invalid username or password');
                    $this->redirect('/login');
                }
                
            } catch (Exception $e) {
                $this->handleException($e, '/login');
            }
        }
        
        $this->renderView('auth/login');
    }
    
    public function logout() {
        if ($this->session->isLoggedIn()) {
            $user = $this->getUser();
            
            // Log logout activity
            $this->logActivity('logout', 'user', $user['id']);
            
            $this->session->destroy();
            $this->session->setFlashMessage('success', 'You have been logged out successfully');
        }
        
        $this->redirect('/login');
    }
    
    public function register() {
        // Only super admin can register new users via web interface
        $this->requireRole('super_admin');
        
        if ($this->isPost()) {
            $this->validateCSRF();
            
            $data = $this->sanitizeInput($_POST);
            
            try {
                $userModel = new User($this->db);
                $result = $userModel->createUser($data);
                
                if ($result['success']) {
                    $this->logActivity('create', 'user', $result['user_id'], null, $data);
                    $this->redirectWithMessage('/users', 'success', 'User created successfully');
                } else {
                    $this->renderView('auth/register', ['errors' => $result['errors'], 'data' => $data]);
                }
                
            } catch (Exception $e) {
                $this->handleException($e, '/users');
            }
        }
        
        $this->renderView('auth/register');
    }
    
    public function forgotPassword() {
        // For now, redirect to login with message
        // In future versions, this can be implemented with email functionality
        $this->session->setFlashMessage('info', 'Please contact your system administrator to reset your password');
        $this->redirect('/login');
    }
}
?>
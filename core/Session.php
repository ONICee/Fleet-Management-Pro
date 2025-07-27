<?php
class Session {
    private $db;
    
    public function __construct($db = null) {
        $this->db = $db;
        $this->startSession();
    }
    
    private function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            // Configure session security
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
            ini_set('session.use_strict_mode', 1);
            
            session_start();
        }
        
        // Regenerate session ID periodically for security
        if (!isset($_SESSION['last_regeneration'])) {
            $this->regenerateSessionId();
        } elseif (time() - $_SESSION['last_regeneration'] > 300) { // 5 minutes
            $this->regenerateSessionId();
        }
    }
    
    private function regenerateSessionId() {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
    
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public function get($key, $default = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }
    
    public function has($key) {
        return isset($_SESSION[$key]);
    }
    
    public function remove($key) {
        unset($_SESSION[$key]);
    }
    
    public function destroy() {
        session_destroy();
        $_SESSION = [];
    }
    
    public function setUser($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['login_time'] = time();
    }
    
    public function getUser() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $this->get('user_id'),
                'username' => $this->get('username'),
                'role' => $this->get('role'),
                'first_name' => $this->get('first_name'),
                'last_name' => $this->get('last_name'),
                'login_time' => $this->get('login_time')
            ];
        }
        return null;
    }
    
    public function isLoggedIn() {
        return $this->has('user_id') && $this->has('username');
    }
    
    public function getUserRole() {
        return $this->get('role', 'guest');
    }
    
    public function hasRole($role) {
        return $this->getUserRole() === $role;
    }
    
    public function hasAnyRole($roles) {
        return in_array($this->getUserRole(), $roles);
    }
    
    public function canAccess($resource) {
        $role = $this->getUserRole();
        $permissions = $this->getRolePermissions($role);
        
        return in_array($resource, $permissions);
    }
    
    private function getRolePermissions($role) {
        $permissions = [
            'super_admin' => [
                'dashboard', 'vehicles', 'agencies', 'locations', 'maintenance', 
                'fuel', 'users', 'notifications', 'reports', 'system_logs',
                'create', 'edit', 'delete', 'view', 'manage_users', 'manage_agencies'
            ],
            'admin' => [
                'dashboard', 'vehicles', 'agencies', 'locations', 'maintenance',
                'fuel', 'notifications', 'reports', 'create', 'edit', 'delete', 'view'
            ],
            'data_entry_officer' => [
                'dashboard', 'vehicles', 'maintenance', 'fuel', 'notifications',
                'create', 'edit', 'view'
            ],
            'guest' => [
                'dashboard', 'vehicles', 'view'
            ]
        ];
        
        return isset($permissions[$role]) ? $permissions[$role] : [];
    }
    
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }
    
    public function requireRole($requiredRole) {
        $this->requireLogin();
        
        if (!$this->hasRole($requiredRole)) {
            header('HTTP/1.1 403 Forbidden');
            include __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }
    
    public function requireAnyRole($requiredRoles) {
        $this->requireLogin();
        
        if (!$this->hasAnyRole($requiredRoles)) {
            header('HTTP/1.1 403 Forbidden');
            include __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }
    
    public function requirePermission($resource) {
        $this->requireLogin();
        
        if (!$this->canAccess($resource)) {
            header('HTTP/1.1 403 Forbidden');
            include __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }
    
    public function setFlashMessage($type, $message) {
        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    public function getFlashMessages() {
        $messages = $this->get('flash_messages', []);
        $this->remove('flash_messages');
        return $messages;
    }
    
    public function generateCSRFToken() {
        if (!$this->has('csrf_token')) {
            $this->set('csrf_token', bin2hex(random_bytes(32)));
        }
        return $this->get('csrf_token');
    }
    
    public function validateCSRFToken($token) {
        return hash_equals($this->get('csrf_token', ''), $token);
    }
}
?>
<?php
require_once __DIR__ . '/BaseModel.php';

class User extends BaseModel {
    protected $table = 'users';
    protected $fillable = [
        'username', 'email', 'password_hash', 'first_name', 'last_name', 
        'role', 'phone', 'status'
    ];
    
    public function authenticate($username, $password) {
        $user = $this->findBy('username', $username);
        
        if ($user && $user['status'] === 'active' && password_verify($password, $user['password_hash'])) {
            // Update last login
            $this->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
            return $user;
        }
        
        return false;
    }
    
    public function createUser($data) {
        // Validate required fields
        $rules = [
            'username' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'role' => 'required'
        ];
        
        $errors = $this->validate($data, $rules);
        
        // Check for unique username and email
        if ($this->findBy('username', $data['username'])) {
            $errors['username'] = 'Username already exists';
        }
        
        if ($this->findBy('email', $data['email'])) {
            $errors['email'] = 'Email already exists';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        // Hash password
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['password']);
        
        $userId = $this->create($data);
        
        if ($userId) {
            return ['success' => true, 'user_id' => $userId];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to create user']];
    }
    
    public function updateUser($id, $data) {
        // Validate data
        $rules = [
            'username' => 'min:3|max:50',
            'email' => 'email',
            'first_name' => 'max:50',
            'last_name' => 'max:50'
        ];
        
        $errors = $this->validate($data, $rules);
        
        // Check for unique username and email (excluding current user)
        if (!empty($data['username'])) {
            $existingUser = $this->findBy('username', $data['username']);
            if ($existingUser && $existingUser['id'] != $id) {
                $errors['username'] = 'Username already exists';
            }
        }
        
        if (!empty($data['email'])) {
            $existingUser = $this->findBy('email', $data['email']);
            if ($existingUser && $existingUser['id'] != $id) {
                $errors['email'] = 'Email already exists';
            }
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        // Hash password if provided
        if (!empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }
        
        $result = $this->update($id, $data);
        
        if ($result) {
            return ['success' => true];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to update user']];
    }
    
    public function changePassword($id, $currentPassword, $newPassword) {
        $user = $this->find($id);
        
        if (!$user) {
            return ['success' => false, 'errors' => ['general' => 'User not found']];
        }
        
        if (!password_verify($currentPassword, $user['password_hash'])) {
            return ['success' => false, 'errors' => ['current_password' => 'Current password is incorrect']];
        }
        
        if (strlen($newPassword) < 6) {
            return ['success' => false, 'errors' => ['new_password' => 'New password must be at least 6 characters']];
        }
        
        $result = $this->update($id, ['password_hash' => password_hash($newPassword, PASSWORD_DEFAULT)]);
        
        if ($result) {
            return ['success' => true];
        }
        
        return ['success' => false, 'errors' => ['general' => 'Failed to change password']];
    }
    
    public function getUsersByRole($role) {
        return $this->findAll(['role' => $role, 'status' => 'active']);
    }
    
    public function getActiveUsers() {
        return $this->findAll(['status' => 'active'], 'first_name ASC, last_name ASC');
    }
    
    public function searchUsers($searchTerm) {
        return $this->search($searchTerm, ['username', 'email', 'first_name', 'last_name']);
    }
    
    public function getUserStats() {
        $stats = [];
        
        $roles = ['super_admin', 'admin', 'data_entry_officer', 'guest'];
        foreach ($roles as $role) {
            $stats[$role] = $this->count(['role' => $role, 'status' => 'active']);
        }
        
        $stats['total_active'] = $this->count(['status' => 'active']);
        $stats['total_inactive'] = $this->count(['status' => 'inactive']);
        $stats['total_suspended'] = $this->count(['status' => 'suspended']);
        
        return $stats;
    }
    
    public function getUserActivity($userId, $limit = 10) {
        $sql = "SELECT * FROM system_logs WHERE user_id = ? ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll();
    }
    
    public function getFullName($user) {
        if (is_array($user)) {
            return trim($user['first_name'] . ' ' . $user['last_name']);
        }
        return '';
    }
    
    public function getRoleDisplayName($role) {
        $roleNames = [
            'super_admin' => 'Super Administrator',
            'admin' => 'Administrator',
            'data_entry_officer' => 'Data Entry Officer',
            'guest' => 'Guest User'
        ];
        
        return $roleNames[$role] ?? ucfirst(str_replace('_', ' ', $role));
    }
    
    public function getUsersWithPagination($page = 1, $perPage = 10, $filters = []) {
        $conditions = [];
        
        if (!empty($filters['role'])) {
            $conditions['role'] = $filters['role'];
        }
        
        if (!empty($filters['status'])) {
            $conditions['status'] = $filters['status'];
        }
        
        return $this->paginate($page, $perPage, $conditions, 'created_at DESC');
    }
}
?>
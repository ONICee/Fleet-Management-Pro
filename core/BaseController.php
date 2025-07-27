<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/../models/SystemLog.php';

class BaseController {
    protected $db;
    protected $session;
    protected $requestMethod;
    protected $params = [];
    
    public function __construct($db, $session) {
        $this->db = $db;
        $this->session = $session;
    }
    
    public function setRequestMethod($method) {
        $this->requestMethod = $method;
    }
    
    public function setParams($params) {
        $this->params = $params;
    }
    
    protected function getParam($key, $default = null) {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }
    
    protected function isPost() {
        return $this->requestMethod === 'POST';
    }
    
    protected function isGet() {
        return $this->requestMethod === 'GET';
    }
    
    protected function requireLogin() {
        $this->session->requireLogin();
    }
    
    protected function requireRole($role) {
        $this->session->requireRole($role);
    }
    
    protected function requireAnyRole($roles) {
        $this->session->requireAnyRole($roles);
    }
    
    protected function requireAnyRole($roles) {
        $this->session->requireAnyRole($roles);
    }
    
    protected function requirePermission($resource) {
        $this->session->requirePermission($resource);
    }
    
    protected function getUser() {
        return $this->session->getUser();
    }
    
    protected function getUserRole() {
        return $this->session->getUserRole();
    }
    
    protected function redirect($url) {
        if (function_exists('url')) {
            header("Location: " . url($url));
        } else {
            header("Location: $url");
        }
        exit;
    }
    
    protected function redirectWithMessage($url, $type, $message) {
        $this->session->setFlashMessage($type, $message);
        $this->redirect($url);
    }
    
    protected function validateCSRF() {
        if ($this->isPost()) {
            $token = $_POST['csrf_token'] ?? '';
            if (!$this->session->validateCSRFToken($token)) {
                $this->redirectWithMessage('/', 'error', 'Invalid CSRF token. Please try again.');
            }
        }
    }
    
    protected function sanitizeInput($input) {
        if (is_array($input)) {
            return array_map([$this, 'sanitizeInput'], $input);
        }
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    protected function validateInput($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? '';
            $ruleList = explode('|', $rule);
            
            foreach ($ruleList as $singleRule) {
                if ($singleRule === 'required' && empty($value)) {
                    $errors[$field] = ucfirst($field) . ' is required';
                    break;
                }
                
                if (strpos($singleRule, 'min:') === 0) {
                    $min = (int)substr($singleRule, 4);
                    if (strlen($value) < $min) {
                        $errors[$field] = ucfirst($field) . " must be at least $min characters";
                        break;
                    }
                }
                
                if (strpos($singleRule, 'max:') === 0) {
                    $max = (int)substr($singleRule, 4);
                    if (strlen($value) > $max) {
                        $errors[$field] = ucfirst($field) . " must be no more than $max characters";
                        break;
                    }
                }
                
                if ($singleRule === 'email' && !empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = ucfirst($field) . ' must be a valid email address';
                    break;
                }
                
                if ($singleRule === 'numeric' && !empty($value) && !is_numeric($value)) {
                    $errors[$field] = ucfirst($field) . ' must be a number';
                    break;
                }
                
                if ($singleRule === 'date' && !empty($value) && !strtotime($value)) {
                    $errors[$field] = ucfirst($field) . ' must be a valid date';
                    break;
                }
            }
        }
        
        return $errors;
    }
    
    protected function logActivity($action, $entityType, $entityId = null, $oldValues = null, $newValues = null) {
        try {
            $systemLog = new SystemLog($this->db);
            $user = $this->getUser();
            
            $logData = [
                'user_id' => $user ? $user['id'] : null,
                'action' => $action,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'old_values' => $oldValues ? json_encode($oldValues) : null,
                'new_values' => $newValues ? json_encode($newValues) : null,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
            ];
            
            $systemLog->create($logData);
        } catch (Exception $e) {
            error_log("Failed to log activity: " . $e->getMessage());
        }
    }
    
    protected function renderView($view, $data = []) {
        // Extract data for use in view
        extract($data);
        
        // Add common data
        $user = $this->getUser();
        $userRole = $this->getUserRole();
        $flashMessages = $this->session->getFlashMessages();
        $csrfToken = $this->session->generateCSRFToken();
        $pageTitle = $data['pageTitle'] ?? 'State Fleet Management System';
        
        // Capture the view content
        ob_start();
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View file not found: $view");
        }
        
        $content = ob_get_contents();
        ob_end_clean();
        
        // Include the layout with content
        include __DIR__ . '/../views/layouts/app.php';
    }
    
    protected function renderAPI($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function handleException($e, $redirectUrl = '/') {
        error_log("Controller Exception: " . $e->getMessage());
        $this->redirectWithMessage($redirectUrl, 'error', 'An error occurred. Please try again.');
    }
    
    protected function paginate($query, $page = 1, $perPage = 10, $params = []) {
        $page = max(1, (int)$page);
        $offset = ($page - 1) * $perPage;
        
        // Count total records
        $countQuery = preg_replace('/^SELECT .+ FROM/i', 'SELECT COUNT(*) as total FROM', $query);
        $stmt = $this->db->prepare($countQuery);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        
        // Get paginated results
        $query .= " LIMIT $offset, $perPage";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll();
        
        return [
            'data' => $results,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total_records' => $total,
                'total_pages' => ceil($total / $perPage),
                'has_previous' => $page > 1,
                'has_next' => $page < ceil($total / $perPage)
            ]
        ];
    }
    
    protected function generateReportData($reportType, $filters = []) {
        // This will be implemented in specific controllers
        return [];
    }
    
    protected function exportToCSV($data, $filename) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        if (!empty($data)) {
            // Write headers
            fputcsv($output, array_keys($data[0]));
            
            // Write data
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
        }
        
        fclose($output);
        exit;
    }
}
?>
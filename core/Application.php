<?php
require_once __DIR__ . '/../config/database.php';

class Application {
    private $db;
    private $router;
    private $session;
    
    public function __construct() {
        $this->initializeSession();
        $this->initializeDatabase();
        $this->initializeRouter();
        $this->initializeErrorHandling();
    }
    
    private function initializeSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/Session.php';
        $this->session = new Session();
    }
    
    private function initializeDatabase() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    private function initializeRouter() {
        require_once __DIR__ . '/Router.php';
        $this->router = new Router();
        $this->setupRoutes();
    }
    
    private function initializeErrorHandling() {
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
    }
    
    private function setupRoutes() {
        // Authentication routes
        $this->router->add('/', 'AuthController@login');
        $this->router->add('/login', 'AuthController@login');
        $this->router->add('/logout', 'AuthController@logout');
        $this->router->add('/dashboard', 'DashboardController@index');
        
        // Vehicle routes
        $this->router->add('/vehicles', 'VehicleController@index');
        $this->router->add('/vehicles/create', 'VehicleController@create');
        $this->router->add('/vehicles/edit/{id}', 'VehicleController@edit');
        $this->router->add('/vehicles/delete/{id}', 'VehicleController@delete');
        $this->router->add('/vehicles/view/{id}', 'VehicleController@view');
        
        // Driver routes
        $this->router->add('/drivers', 'DriverController@index');
        $this->router->add('/drivers/create', 'DriverController@create');
        $this->router->add('/drivers/edit/{id}', 'DriverController@edit');
        $this->router->add('/drivers/delete/{id}', 'DriverController@delete');
        $this->router->add('/drivers/view/{id}', 'DriverController@view');
        
        // Trip routes
        $this->router->add('/trips', 'TripController@index');
        $this->router->add('/trips/create', 'TripController@create');
        $this->router->add('/trips/edit/{id}', 'TripController@edit');
        $this->router->add('/trips/view/{id}', 'TripController@view');
        $this->router->add('/trips/start/{id}', 'TripController@start');
        $this->router->add('/trips/complete/{id}', 'TripController@complete');
        
        // Maintenance routes
        $this->router->add('/maintenance', 'MaintenanceController@index');
        $this->router->add('/maintenance/schedule', 'MaintenanceController@schedule');
        $this->router->add('/maintenance/edit/{id}', 'MaintenanceController@edit');
        $this->router->add('/maintenance/complete/{id}', 'MaintenanceController@complete');
        
        // Fuel routes
        $this->router->add('/fuel', 'FuelController@index');
        $this->router->add('/fuel/record', 'FuelController@record');
        $this->router->add('/fuel/edit/{id}', 'FuelController@edit');
        
        // User management routes
        $this->router->add('/users', 'UserController@index');
        $this->router->add('/users/create', 'UserController@create');
        $this->router->add('/users/edit/{id}', 'UserController@edit');
        $this->router->add('/users/profile', 'UserController@profile');
        
        // Notification routes
        $this->router->add('/notifications', 'NotificationController@index');
        $this->router->add('/notifications/mark-read/{id}', 'NotificationController@markRead');
        $this->router->add('/notifications/mark-all-read', 'NotificationController@markAllRead');
        
        // API routes for AJAX
        $this->router->add('/api/notifications/unread', 'ApiController@getUnreadNotifications');
        $this->router->add('/api/vehicles/status', 'ApiController@getVehicleStatus');
        $this->router->add('/api/trips/active', 'ApiController@getActiveTrips');
        $this->router->add('/api/dashboard/stats', 'ApiController@getDashboardStats');
        
        // Reports routes
        $this->router->add('/reports', 'ReportController@index');
        $this->router->add('/reports/vehicles', 'ReportController@vehicles');
        $this->router->add('/reports/fuel', 'ReportController@fuel');
        $this->router->add('/reports/maintenance', 'ReportController@maintenance');
        $this->router->add('/reports/trips', 'ReportController@trips');
    }
    
    public function run() {
        try {
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];
            
            // Remove query string from URI
            if (($pos = strpos($uri, '?')) !== false) {
                $uri = substr($uri, 0, $pos);
            }
            
            $this->router->dispatch($uri, $method, $this->db, $this->session);
            
        } catch (Exception $e) {
            $this->handleException($e);
        }
    }
    
    public function handleError($severity, $message, $file, $line) {
        if (!(error_reporting() & $severity)) {
            return false;
        }
        
        $error = [
            'severity' => $severity,
            'message' => $message,
            'file' => $file,
            'line' => $line
        ];
        
        error_log("PHP Error: " . json_encode($error));
        
        if ($severity === E_ERROR || $severity === E_USER_ERROR) {
            $this->showErrorPage('An error occurred', $message);
        }
        
        return true;
    }
    
    public function handleException($exception) {
        error_log("Uncaught Exception: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine());
        
        if (defined('DEBUG') && DEBUG) {
            $this->showErrorPage('Exception', $exception->getMessage() . '<br><pre>' . $exception->getTraceAsString() . '</pre>');
        } else {
            $this->showErrorPage('System Error', 'An unexpected error occurred. Please try again later.');
        }
    }
    
    private function showErrorPage($title, $message) {
        http_response_code(500);
        include __DIR__ . '/../views/errors/500.php';
        exit;
    }
}
?>
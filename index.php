<?php
// Error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define application constants
define('DEBUG', true);
define('APP_ROOT', __DIR__);
define('APP_NAME', 'State Fleet Management System');
define('APP_VERSION', '1.0.0');

// Start output buffering
ob_start();

// Include required core files
require_once __DIR__ . '/core/Application.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/Session.php';
require_once __DIR__ . '/core/BaseController.php';

try {
    // Initialize and run the application
    $app = new Application();
    $app->run();
    
} catch (Exception $e) {
    // Log the error
    error_log("Application Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
    
    // Show user-friendly error page
    if (DEBUG) {
        echo '<h1>Application Error</h1>';
        echo '<p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . '</p>';
        echo '<p><strong>Line:</strong> ' . $e->getLine() . '</p>';
        echo '<h3>Stack Trace:</h3>';
        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    } else {
        include __DIR__ . '/views/errors/500.php';
    }
}

// End output buffering and send output
ob_end_flush();
?>
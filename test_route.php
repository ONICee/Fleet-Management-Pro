<?php
// Simple routing test
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Routing Test</h1>";

// Include necessary files
require_once __DIR__ . '/core/helpers.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/Session.php';

// Test the routing logic
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

echo "<h2>Current Request</h2>";
echo "<p><strong>Original URI:</strong> $uri</p>";
echo "<p><strong>Method:</strong> $method</p>";

// Remove query string from URI
if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}

// Handle subdirectory installations
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = dirname($scriptName);

echo "<p><strong>Script Name:</strong> $scriptName</p>";
echo "<p><strong>Base Path:</strong> $basePath</p>";

// Remove base path from URI if running in subdirectory
if ($basePath !== '/' && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
    echo "<p><strong>After removing base path:</strong> $uri</p>";
}

// Ensure URI starts with /
if (empty($uri) || $uri[0] !== '/') {
    $uri = '/' . $uri;
}

echo "<p><strong>Final URI for routing:</strong> $uri</p>";

// Test database connection
try {
    $database = new Database();
    $db = $database->getConnection();
    echo "<p style='color: green;'><strong>✅ Database Connected</strong></p>";
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>❌ Database Error:</strong> " . $e->getMessage() . "</p>";
    $db = null;
}

// Test router
try {
    $router = new Router();
    
    // Add the routes manually to test
    $router->add('/', 'AuthController@login');
    $router->add('/login', 'AuthController@login');
    $router->add('/dashboard', 'DashboardController@index');
    
    echo "<h2>Router Test</h2>";
    echo "<p>Testing route: <strong>$uri</strong></p>";
    
    // Create a simple session object
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $session = new Session();
    
    // Try to dispatch
    echo "<p>Attempting to dispatch...</p>";
    
    if ($db) {
        $router->dispatch($uri, $method, $db, $session);
    } else {
        echo "<p style='color: red;'>Cannot test routing without database connection</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Router Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Stack trace:</strong></p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
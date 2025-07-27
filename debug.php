<?php
// Debug information for Fleet Management System
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Fleet Management System - Debug Information</h1>";
echo "<p><strong>URL Access Test:</strong> " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "</p>";

echo "<h2>Server Variables</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Variable</th><th>Value</th></tr>";

$serverVars = [
    'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? 'Not set',
    'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'] ?? 'Not set',
    'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'Not set',
    'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'] ?? 'Not set',
    'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'] ?? 'Not set'
];

foreach ($serverVars as $var => $value) {
    echo "<tr><td><strong>$var</strong></td><td>$value</td></tr>";
}
echo "</table>";

echo "<h2>Path Analysis</h2>";
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = dirname($scriptName);
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

// Remove query string
if (($pos = strpos($requestUri, '?')) !== false) {
    $requestUri = substr($requestUri, 0, $pos);
}

echo "<table border='1' cellpadding='5'>";
echo "<tr><td><strong>Script Name</strong></td><td>$scriptName</td></tr>";
echo "<tr><td><strong>Base Path (dirname)</strong></td><td>$basePath</td></tr>";
echo "<tr><td><strong>Original REQUEST_URI</strong></td><td>" . ($_SERVER['REQUEST_URI'] ?? '') . "</td></tr>";
echo "<tr><td><strong>Cleaned REQUEST_URI</strong></td><td>$requestUri</td></tr>";

// Simulate the routing logic
if ($basePath !== '/' && strpos($requestUri, $basePath) === 0) {
    $cleanUri = substr($requestUri, strlen($basePath));
} else {
    $cleanUri = $requestUri;
}

if (empty($cleanUri) || $cleanUri[0] !== '/') {
    $cleanUri = '/' . $cleanUri;
}

echo "<tr><td><strong>Final Clean URI for Routing</strong></td><td>$cleanUri</td></tr>";
echo "</table>";

echo "<h2>Database Test</h2>";
try {
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $conn = $database->getConnection();
    
    if ($conn) {
        echo "<p style='color: green;'><strong>✅ Database Connection: SUCCESS</strong></p>";
        
        // Test a simple query
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users");
        $stmt->execute();
        $result = $stmt->fetch();
        
        echo "<p>Users in database: " . ($result['count'] ?? 'Unable to count') . "</p>";
    } else {
        echo "<p style='color: red;'><strong>❌ Database Connection: FAILED</strong></p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>❌ Database Error:</strong> " . $e->getMessage() . "</p>";
}

echo "<h2>File System Check</h2>";
$requiredFiles = [
    'index.php',
    'core/Application.php',
    'core/Router.php',
    'config/database.php',
    'controllers/AuthController.php',
    'views/auth/login.php',
    '.htaccess'
];

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>File</th><th>Status</th></tr>";

foreach ($requiredFiles as $file) {
    $exists = file_exists(__DIR__ . '/' . $file);
    $status = $exists ? '✅ EXISTS' : '❌ MISSING';
    $color = $exists ? 'green' : 'red';
    echo "<tr><td>$file</td><td style='color: $color;'><strong>$status</strong></td></tr>";
}
echo "</table>";

echo "<h2>URL Helper Test</h2>";
if (file_exists(__DIR__ . '/core/helpers.php')) {
    require_once __DIR__ . '/core/helpers.php';
    
    $testPaths = ['', '/', '/login', '/dashboard', '/vehicles'];
    
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Input Path</th><th>Generated URL</th></tr>";
    
    foreach ($testPaths as $path) {
        $generatedUrl = url($path);
        echo "<tr><td>'$path'</td><td>$generatedUrl</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ helpers.php not found</p>";
}

echo "<h2>Next Steps</h2>";
echo "<ul>";
echo "<li>If database connection is successful, try accessing <a href='" . url('/') . "'>the main application</a></li>";
echo "<li>If you see errors above, fix them first</li>";
echo "<li>Check that mod_rewrite is enabled in Apache</li>";
echo "<li>Verify .htaccess file is being read</li>";
echo "</ul>";

echo "<hr>";
echo "<p><small>Debug file location: " . __FILE__ . "</small></p>";
echo "<p><small>Current working directory: " . getcwd() . "</small></p>";
?>
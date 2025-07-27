<?php
/**
 * Fleet Management System Installation Test
 * 
 * This script checks if the system is properly installed and configured.
 * Run this script via web browser to verify your installation.
 */

// Start output buffering
ob_start();

// Check PHP version
$phpVersion = PHP_VERSION;
$phpOk = version_compare($phpVersion, '7.4.0', '>=');

// Check required extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'json', 'openssl', 'mbstring', 'curl'];
$extensionStatus = [];
foreach ($requiredExtensions as $ext) {
    $extensionStatus[$ext] = extension_loaded($ext);
}

// Check file permissions
$writableDirectories = ['logs'];
$permissionStatus = [];
foreach ($writableDirectories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
    $permissionStatus[$dir] = is_writable($dir);
}

// Test database connection
$dbStatus = false;
$dbError = '';
try {
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $connection = $database->getConnection();
    
    if ($connection) {
        // Test if tables exist
        $stmt = $connection->query("SHOW TABLES LIKE 'users'");
        $tablesExist = $stmt->rowCount() > 0;
        
        if ($tablesExist) {
            $dbStatus = 'connected_with_tables';
        } else {
            $dbStatus = 'connected_no_tables';
        }
    }
} catch (Exception $e) {
    $dbError = $e->getMessage();
    $dbStatus = false;
}

// Check .htaccess
$htaccessExists = file_exists('.htaccess');

// Overall status
$overallStatus = $phpOk && 
                 !in_array(false, $extensionStatus) && 
                 !in_array(false, $permissionStatus) && 
                 ($dbStatus === 'connected_with_tables') && 
                 $htaccessExists;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Test - State Fleet Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        .test-card {
            background: linear-gradient(135deg, #2d2d2d 0%, #404040 100%);
            border: 1px solid #FFD700;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        .test-header {
            background: linear-gradient(90deg, #FFD700, #DAA520);
            color: #1a1a1a;
            font-weight: bold;
            border-radius: 14px 14px 0 0;
        }
        .status-pass { color: #28a745; }
        .status-fail { color: #dc3545; }
        .status-warning { color: #ffc107; }
        .overall-status {
            font-size: 1.2rem;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .status-success {
            background: linear-gradient(45deg, rgba(40, 167, 69, 0.2), rgba(40, 167, 69, 0.1));
            border-left: 4px solid #28a745;
        }
        .status-error {
            background: linear-gradient(45deg, rgba(220, 53, 69, 0.2), rgba(220, 53, 69, 0.1));
            border-left: 4px solid #dc3545;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="text-center mb-5">
                    <i class="fas fa-cogs" style="font-size: 3rem; color: #FFD700; margin-bottom: 20px;"></i>
                    <h1 class="mb-2" style="color: #FFD700;">Installation Test</h1>
                    <p class="text-muted">State Fleet Management System</p>
                </div>

                <!-- Overall Status -->
                <div class="overall-status <?= $overallStatus ? 'status-success' : 'status-error' ?>">
                    <div class="d-flex align-items-center">
                        <i class="fas <?= $overallStatus ? 'fa-check-circle status-pass' : 'fa-exclamation-triangle status-fail' ?> me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h4 class="mb-1">
                                <?= $overallStatus ? 'Installation Successful' : 'Installation Issues Detected' ?>
                            </h4>
                            <p class="mb-0">
                                <?= $overallStatus 
                                    ? 'Your fleet management system is properly configured and ready for use.' 
                                    : 'Please review and fix the issues below before proceeding.' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- PHP Version Check -->
                <div class="test-card">
                    <div class="card-header test-header">
                        <i class="fab fa-php me-2"></i>PHP Configuration
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>PHP Version:</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="<?= $phpOk ? 'status-pass' : 'status-fail' ?>">
                                    <i class="fas <?= $phpOk ? 'fa-check' : 'fa-times' ?> me-1"></i>
                                    <?= $phpVersion ?> <?= $phpOk ? '(Compatible)' : '(Requires 7.4+)' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Extensions Check -->
                <div class="test-card">
                    <div class="card-header test-header">
                        <i class="fas fa-puzzle-piece me-2"></i>PHP Extensions
                    </div>
                    <div class="card-body">
                        <?php foreach ($extensionStatus as $ext => $status): ?>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><?= strtoupper($ext) ?>:</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="<?= $status ? 'status-pass' : 'status-fail' ?>">
                                    <i class="fas <?= $status ? 'fa-check' : 'fa-times' ?> me-1"></i>
                                    <?= $status ? 'Installed' : 'Missing' ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- File Permissions -->
                <div class="test-card">
                    <div class="card-header test-header">
                        <i class="fas fa-folder-open me-2"></i>File Permissions
                    </div>
                    <div class="card-body">
                        <?php foreach ($permissionStatus as $dir => $status): ?>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><?= $dir ?>/ directory:</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="<?= $status ? 'status-pass' : 'status-fail' ?>">
                                    <i class="fas <?= $status ? 'fa-check' : 'fa-times' ?> me-1"></i>
                                    <?= $status ? 'Writable' : 'Not Writable' ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Database Connection -->
                <div class="test-card">
                    <div class="card-header test-header">
                        <i class="fas fa-database me-2"></i>Database Connection
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong>Connection Status:</strong>
                            </div>
                            <div class="col-sm-6">
                                <?php if ($dbStatus === 'connected_with_tables'): ?>
                                    <span class="status-pass">
                                        <i class="fas fa-check me-1"></i>Connected with Tables
                                    </span>
                                <?php elseif ($dbStatus === 'connected_no_tables'): ?>
                                    <span class="status-warning">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Connected but No Tables
                                    </span>
                                <?php else: ?>
                                    <span class="status-fail">
                                        <i class="fas fa-times me-1"></i>Connection Failed
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($dbError): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <strong>Error:</strong> <?= htmlspecialchars($dbError) ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($dbStatus === 'connected_no_tables'): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <strong>Note:</strong> Database connected but tables not found. 
                                    Please import the database schema from <code>database/schema.sql</code>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- URL Rewriting -->
                <div class="test-card">
                    <div class="card-header test-header">
                        <i class="fas fa-link me-2"></i>URL Rewriting
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong>.htaccess file:</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="<?= $htaccessExists ? 'status-pass' : 'status-fail' ?>">
                                    <i class="fas <?= $htaccessExists ? 'fa-check' : 'fa-times' ?> me-1"></i>
                                    <?= $htaccessExists ? 'Present' : 'Missing' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <?php if ($overallStatus): ?>
                        <a href="/" class="btn btn-success btn-lg">
                            <i class="fas fa-rocket me-2"></i>
                            Launch Application
                        </a>
                    <?php else: ?>
                        <button onclick="location.reload()" class="btn btn-warning btn-lg">
                            <i class="fas fa-sync-alt me-2"></i>
                            Retest Installation
                        </button>
                    <?php endif; ?>
                    
                    <a href="INSTALLATION.md" class="btn btn-outline-info btn-lg ms-3">
                        <i class="fas fa-book me-2"></i>
                        View Documentation
                    </a>
                </div>

                <!-- Next Steps -->
                <?php if ($overallStatus): ?>
                <div class="test-card mt-4">
                    <div class="card-header test-header">
                        <i class="fas fa-list-check me-2"></i>Next Steps
                    </div>
                    <div class="card-body">
                        <ol class="mb-0">
                            <li>Delete or rename this test file (<code>test_installation.php</code>)</li>
                            <li>Log in with default credentials and change passwords</li>
                            <li>Configure agencies and deployment locations</li>
                            <li>Add your vehicle fleet data</li>
                            <li>Set up regular maintenance schedules</li>
                            <li>Configure system backups</li>
                        </ol>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Security Notice -->
                <div class="alert alert-info mt-4">
                    <h6><i class="fas fa-shield-alt me-2"></i>Security Notice</h6>
                    <p class="mb-0">
                        For production use, ensure you have completed the security checklist in the installation documentation.
                        This includes changing default passwords, configuring SSL, and setting proper file permissions.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// End output buffering and send
ob_end_flush();
?>
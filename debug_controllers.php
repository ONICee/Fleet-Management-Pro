<?php
// Debug script to test controllers and identify issues
session_start();

// Include required files
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Database.php';

echo "<h1>Debug Controller Issues</h1>";

try {
    // Test database connection
    echo "<h2>1. Database Connection Test</h2>";
    $database = new Database($host, $db_name, $username, $password);
    $db = $database->getConnection();
    echo "✅ Database connection: SUCCESS<br>";
    
    // Test if tables exist
    echo "<h2>2. Table Existence Test</h2>";
    $tables = ['fuel_records', 'system_logs', 'maintenance_schedules', 'maintenance_history'];
    foreach ($tables as $table) {
        $sql = "SHOW TABLES LIKE ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$table]);
        if ($stmt->fetch()) {
            echo "✅ Table '$table': EXISTS<br>";
        } else {
            echo "❌ Table '$table': MISSING<br>";
        }
    }
    
    // Test FuelRecord model
    echo "<h2>3. FuelRecord Model Test</h2>";
    require_once __DIR__ . '/models/FuelRecord.php';
    $fuelModel = new FuelRecord($db);
    
    try {
        $stats = $fuelModel->getFuelStats();
        echo "✅ FuelRecord::getFuelStats(): SUCCESS<br>";
        echo "Stats: " . json_encode($stats) . "<br>";
    } catch (Exception $e) {
        echo "❌ FuelRecord::getFuelStats(): ERROR - " . $e->getMessage() . "<br>";
    }
    
    try {
        $records = $fuelModel->getFuelRecordsWithDetails(5);
        echo "✅ FuelRecord::getFuelRecordsWithDetails(): SUCCESS<br>";
        echo "Records count: " . count($records) . "<br>";
    } catch (Exception $e) {
        echo "❌ FuelRecord::getFuelRecordsWithDetails(): ERROR - " . $e->getMessage() . "<br>";
    }
    
    // Test SystemLog model
    echo "<h2>4. SystemLog Model Test</h2>";
    require_once __DIR__ . '/models/SystemLog.php';
    $systemLogModel = new SystemLog($db);
    
    try {
        $recentActivity = $systemLogModel->getRecentActivity(5);
        echo "✅ SystemLog::getRecentActivity(): SUCCESS<br>";
        echo "Activity count: " . count($recentActivity) . "<br>";
    } catch (Exception $e) {
        echo "❌ SystemLog::getRecentActivity(): ERROR - " . $e->getMessage() . "<br>";
    }
    
    try {
        $stats = $systemLogModel->getActivityStats();
        echo "✅ SystemLog::getActivityStats(): SUCCESS<br>";
        echo "Stats: " . json_encode($stats) . "<br>";
    } catch (Exception $e) {
        echo "❌ SystemLog::getActivityStats(): ERROR - " . $e->getMessage() . "<br>";
    }
    
    // Test data existence
    echo "<h2>5. Data Count Test</h2>";
    foreach ($tables as $table) {
        try {
            $sql = "SELECT COUNT(*) FROM $table";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            echo "📊 Table '$table': $count records<br>";
        } catch (Exception $e) {
            echo "❌ Table '$table': ERROR - " . $e->getMessage() . "<br>";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Critical Error: " . $e->getMessage() . "<br>";
}

echo "<h2>6. Sample Data Loading</h2>";
echo "If tables are empty, run: <br>";
echo "<code>SOURCE " . __DIR__ . "/database/sample_data.sql;</code><br>";
echo "<code>SOURCE " . __DIR__ . "/database/sample_vehicle_data.sql;</code><br>";
?>
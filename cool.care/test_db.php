<?php
// Test database connection and setup
require_once 'backend/config.php';

try {
    echo "Database connection successful!<br>";

    // Check if tables exist
    $tables = ['service_requests', 'admin'];
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "Table '$table' exists.<br>";
        } else {
            echo "Table '$table' does not exist.<br>";
        }
    }

    // Check admin user
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Admin users count: " . $result['count'] . "<br>";

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "<br>";
}
?>

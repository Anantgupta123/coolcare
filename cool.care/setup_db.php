<?php
// Setup database and tables
require_once 'backend/config.php';

try {
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS coolcare");
    $pdo->exec("USE coolcare");

    // Create service_requests table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS service_requests (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            service VARCHAR(255) NOT NULL,
            note TEXT,
            status ENUM('Pending', 'Completed') DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Create admin table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL
        )
    ");

    // Insert default admin user
    $stmt = $pdo->prepare("INSERT IGNORE INTO admin (email, password) VALUES (?, ?)");
    $stmt->execute(['admin@coolcare.com', md5('admin123')]);

    echo "Database setup completed successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

-- Database: coolcare
-- Tables: service_requests, admin

CREATE DATABASE IF NOT EXISTS coolcare;
USE coolcare;

-- Table: service_requests
CREATE TABLE IF NOT EXISTS service_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    service VARCHAR(255) NOT NULL,
    note TEXT,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin user (password: admin123 hashed with MD5 for simplicity, but use stronger hashing in production)
INSERT INTO admin (email, password) VALUES ('admin@coolcare.com', MD5('admin123'));

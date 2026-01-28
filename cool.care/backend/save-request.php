<?php
header('Content-Type: application/json');

// Include database configuration
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get and sanitize input
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$service = trim($_POST['service'] ?? '');
$note = trim($_POST['note'] ?? '');

// Validation
$errors = [];
if (empty($name)) {
    $errors[] = 'Name is required';
}
if (empty($phone)) {
    $errors[] = 'Phone number is required';
}
if (empty($service)) {
    $errors[] = 'Service selection is required';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Insert into database
try {
    $stmt = $pdo->prepare("INSERT INTO service_requests (name, phone, service, note) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $service, $note]);

    echo json_encode(['success' => true, 'message' => 'Service request submitted successfully']);
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Failed to submit request. Please try again.']);
}
?>

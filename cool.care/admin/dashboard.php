<?php
session_start();

// Check if logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Include database configuration
require_once '../backend/config.php';

// Get request counts
try {
    $totalRequests = $pdo->query("SELECT COUNT(*) as count FROM service_requests")->fetch(PDO::FETCH_ASSOC)['count'];
    $pendingRequests = $pdo->query("SELECT COUNT(*) as count FROM service_requests WHERE status = 'Pending'")->fetch(PDO::FETCH_ASSOC)['count'];
    $completedRequests = $pdo->query("SELECT COUNT(*) as count FROM service_requests WHERE status = 'Completed'")->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    die("Error fetching request counts: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cool Care Admin</title>
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Cool Care Admin</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="requests.php">Requests</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Dashboard</h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Requests</h5>
                        <h2><?php echo $totalRequests; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Requests</h5>
                        <h2><?php echo $pendingRequests; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Completed Requests</h5>
                        <h2><?php echo $completedRequests; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Recent Requests</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $pdo->query("SELECT name, phone, service, status, created_at FROM service_requests ORDER BY created_at DESC LIMIT 5");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['service']) . "</td>";
                                    echo "<td><span class='badge bg-" . ($row['status'] === 'Completed' ? 'success' : 'warning') . "'>" . $row['status'] . "</span></td>";
                                    echo "<td>" . $row['created_at'] . "</td>";
                                    echo "</tr>";
                                }
                            } catch (PDOException $e) {
                                echo "<tr><td colspan='5'>Error loading recent requests.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <a href="requests.php" class="btn btn-primary">View All Requests</a>
            </div>
        </div>
    </div>

    <!-- MDBootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
</body>
</html>

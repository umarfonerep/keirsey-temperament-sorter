<?php
session_start();

include '../includes/auth.php';
include '../includes/db.php';
include '../includes/results.php';

$results = new Results($conn);
$data = $results->getAlldata();

$resultdatas = $data['personality_data'];
$users = $data['users'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.html">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_questions.php">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_results.php">Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../includes/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container-content">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Personality Type</th>
                        <th>Group</th>
                        <th>Aspects</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultdatas as $index => $resultdata): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($users[$index]["username"] ?? "Unknown", ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["personality_type"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["result_group"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["aspects"], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
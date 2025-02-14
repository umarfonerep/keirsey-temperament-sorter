<?php
include '../includes/auth.php';
include '../includes/db.php';
include '../includes/results.php';

$results = new Results($conn);
$data = $results->getAlldata();
$resultdatas = $data['results'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Keirsey Temperament Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: black;
        }

        .navbar {
            background-color: #1E7AC2;
            /* border-bottom: 1px solid black; */
        }

        .navbar-brand img {
            height: 80px;
            /* Adjust the logo size */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .nav-item {
            margin-right: 1.5rem;
        }

        .btn-logout {
            background-color: #F77F2E;
            color: white;
            /* border: 2px solid white; */
        }

        .btn-logout:hover {
            background-color: black;
            color: white;
        }

        .container-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 85vh;
        }

        .btn-custom {
            width: 200px;
            margin: 10px;
            border: 2px solid #1E7AC2;
            color: black;

        }

        .btn-custom:hover {
            background-color: #F77F2E;
            color: white;
        }

        .bg-color {
            background-color: #1E7AC2;
            color: white !important;
        }

        /* Footer */
        .footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
            color: #555;
            width: 100%;
        }
    </style>
</head>

<body>

    <?php
    include 'navbar.php';
    ?>
    <!-- Admin Dashboard Content -->
    <!-- Dashboard Content -->
    <div class="container container-content ">
        <h1>Keirsey Temperament Test</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="background-color: #1E7AC2;">
                        <th>User Name</th>
                        <th>Personality Type</th>
                        <th>Group</th>
                        <th>Aspects</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultdatas as $resultdata): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($resultdata["username"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["personality_type"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["result_group"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["aspects"], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <footer class="footer mt-auto">
        <div class="container">
            &copy; 2025 Keirsey Temperament Test. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
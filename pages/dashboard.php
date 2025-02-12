<?php
// session_start();
// include '../includes/auth.php';

// if (!isLoggedIn() || $_SESSION['role'] !== 'user' ) {
//     header("Location: ../pages/login.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            height: 80px; /* Adjust the logo size */
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }
        .nav-link {
            color: white !important;
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
        .bg-color{
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
                <img src="../assets/LOGO.png" alt="Logo">
        </a>
            <div class="ms-auto">
                <a href="../includes/logout.php" class="btn btn-logout">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container-content">
        <h1>Keirsey Temperament Test</h1>
        <div class="table-responsive">
            <table class="table table-bordered";>
                <thead class="table-dark">
                    <tr style = "background-color: #1E7AC2;">
                        <th>Type</th>
                        <th>Group</th>
                        <th>Aspect</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Extrovert</td>
                        <td>Social</td>
                        <td>Leadership</td>
                        <td>Great at handling social situations.</td>
                    </tr>
                    <tr>
                        <td>Introvert</td>
                        <td>Reflective</td>
                        <td>Thoughtful</td>
                        <td>Prefers deep conversations over small talk.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="test.php"><button class="btn btn-custom bg-color">Take Test</button></a>
        <a href="#"><button class="btn btn-custom">Retake Test</button></a>
    </div>

<!-- footer -->
    <footer class="footer mt-auto">
    <div class="container">
        &copy; 2025 Keirsey Temperament Test. All Rights Reserved.
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

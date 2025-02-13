<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet"> <!-- Custom styles if needed -->
    <style>
        /* Ensure full-page layout */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background-color: #1E7AC2;
            padding: 10px 0;
        }
        .navbar-brand img {
            height: 80px;
        }
        .nav-item{
            margin-right: 1.5rem;
        }
        .navbar .nav-link {
            color: white !important;
            font-weight: bold;
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

        .navbar .nav-link:hover {
            color: #f8f9fa !important;
        }

        /* Main Content (pushes footer down) */
        .container-content {
            flex-grow: 1; /* This makes sure the content expands and pushes footer to bottom */
        }

        /* Results Table */
        .table thead {
            background-color: #1E7AC2;
            color: white;
        }

        /* Sticky Footer */
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
<?php
include 'navbar.php';
?>

<!-- Results Section -->
<div class="container mt-5 container-content">
    <h2 class="text-center mb-4">Results</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                   <th>User Name</th>
                    <th>Type</th>
                    <th>Group</th>
                    <th>Aspect</th>                
                  </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ehtisham</td>
                    <td>Extrovert</td>
                    <td>Social</td>
                    <td>Leadership</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer (Sticks to Bottom) -->
<footer class="footer mt-auto">
    <div class="container">
        &copy; 2025 Keirsey Temperament Test. All Rights Reserved.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
            height: 80%;
            background-color: white;
            color: black;
        }
        .navbar {
            background-color: #1E7AC2;
            padding: 10px 0;
        }
        .navbar-brand img {
            height: 80px;
        }
        .navbar .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .navbar .nav-link:hover {
            color: #f8f9fa !important;
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
            height: 79vh;
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
        .table thead {
            background-color: #1E7AC2;
            color: white;
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
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="../assets/LOGO.png" alt="Logo" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_questions.php">Questions</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_results.php">Results</a></li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Dashboard Content -->
    <div class="container-content">
        <h1>Keirsey Temperament Test</h1>
        <div class="table-responsive">
            <table class="table table-bordered";>
                <thead>
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


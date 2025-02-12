<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Keirsey Temperament Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            background-color: white;
            color: black;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .navbar {
            background-color: #1E7AC2;
            padding: 10px 0;
        }
        .navbar .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .navbar .nav-link:hover {
            color: #f8f9fa !important;
        }
        .navbar .btn-logout {
            background-color: white;
            color: black;
            border: none;
            padding: 5px 15px;
            font-weight: bold;
        }
        .navbar .btn-logout:hover {
            background-color: #f8f9fa;
        }
        .container-content {
            max-width: 500px;
            margin: auto;
            text-align: center;
        }
        .btn {
            width: 100%;
            margin-bottom: 15px;
        }
        .btn-transparent {
            background-color: transparent;
            border: 2px solid black;
            color: black;
        }
        .btn-transparent:hover {
            background-color: black;
            color: white;
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

<!-- Admin Dashboard Content -->
<div class="container-content mt-5">
    <h1>Keirsey Temperament Test</h1>
    <a href="test.php" class="btn btn-transparent">Take Test</a>
    <button class="btn btn-secondary">Retake Test</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

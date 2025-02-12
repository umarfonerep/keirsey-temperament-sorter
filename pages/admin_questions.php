<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles.css" rel="stylesheet">
    <style>
        /* Full height layout */
        html, body {
            height: 100%;
            margin: 0;
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
        .navbar .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .navbar .nav-link:hover {
            color: #f8f9fa !important;
        }

        /* Content container to push footer down */
        .container-content {
            flex-grow: 1; /* Expands and pushes footer down */
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

<!-- Questions Section -->
<div class="container mt-5 container-content">
    <h2 class="text-dark">Manage Questions</h2>
    <table class="table table-bordered table-light mt-3">
        <thead>
            <tr>
                <th>Question</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><p>When the phone rings, you hurry to get to it first and don't hope someone else gets it.</p></td>
                <td>
                    <button class="btn btn-warning">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
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

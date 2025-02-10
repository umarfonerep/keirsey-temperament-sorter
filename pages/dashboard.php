<?php

session_start();
include '../includes/auth.php';

if (!isLoggedIn()) {
    header("Location: ../pages/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="gradient-custom d-flex align-items-center justify-content-center vh-100">
<a href="../includes/logout.php">logout</a>
    <div class="container">
        <div class="card bg-dark text-white p-5 text-start" style="border-radius: 1rem;">
            <h1 class="fw-bold text-uppercase">The Keirsey Temperament Questionnaire</h1>
            <p class="fs-4 mt-3">Discover your temperament and personality traits by taking this simple test.</p>
            
            <!-- Take Test Button -->
            <div class="mt-4">
                <a href="test.php" class="btn btn-outline-light btn-lg">
                    Take Test <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Retake Button -->
            <div class="mt-3">
                <a href="test.html" class="btn btn-outline-light btn-lg">Retake</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

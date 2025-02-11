<?php
session_start();
include '../includes/auth.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'user' ) {
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
    <style>
        body {
            height: 100vh;
            background-color: #212529;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 30px;
            padding-right: 30px;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .btn {
            width: 100%;
            margin-bottom: 15px;
        }
        .btn-transparent {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        .btn:hover{
          background-color: #fff;
          color: black;
        }
    </style>
</head>
<body class="gradient-custom d-flex align-items-center justify-content-center vh-100">
<a href="../includes/logout.php">logout</a>
    <div class="container">
    <div class="container">
        <h1>Keirsey Temperament Test</h1>
        <a href="test.html"><button class="btn btn-transparent">Take Test</button> </a>
        <a href = "#"><button class="btn btn-secondary">Retake Test</button></a>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
include '../includes/auth.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="../includes/logout.php">logout</a>
</body>
</html>
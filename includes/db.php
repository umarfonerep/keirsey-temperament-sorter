<?php
$host = "localhost";
$username = "root";
$password = "your_secure_password";
$database = "keirsey";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
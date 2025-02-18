<?php
session_start();
require_once "../includes/db.php";
include '../includes/auth.php';
include '../includes/results.php';

$message = "";
$email = "";
$user_id = $_SESSION['user_id']; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $shareresultobj = new Results($conn);
    if ($shareresultobj->shareResultLink($user_id,$email)) {
        $_SESSION['message'] = "<div class='alert alert-success'>A share Result link has been sent to your email.</div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger'>Failed to send the share Result. Please try again.</div>";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-80">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-white" style="border-radius: 1rem; background-color: #1E7AC2;">
                        <div class="card-body p-5 text-center">
                            
                            <!-- Logo Section -->
                            <div class="mb-4">
                                <img src="../assets/logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
                            </div>

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold text-white mb-2 text-uppercase result-text">Share Result</h2>
                                <?php
                                if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']); // Remove message after showing
                                }
                                ?>
                                <form method="POST" action="">
                                    <div class="form-outline form-white mb-4 result-text">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" required placeholder="Enter email">
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Send email</button>
                                </form>
                                <div class="d-flex justify-content-center text-center mt-4 pt-1  result-text">
                                    <a href="./dashboard.php" class="text-white">Go Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
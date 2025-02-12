<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['q1'];
    echo $data;
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
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
            background-color: #0f5b9b;
            color: white;
        }
        .card {
            border-radius: 1rem;
            background-color: #1E7AC2;
        }
        .form-select {
            width: auto;
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

    <!-- Test Form -->
    <div class="container py-5">
        <div class="card text-white p-5">

            <!-- Heading with Reset Button -->
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="fw-bold text-uppercase text-start mb-0">Keirsey Temperament Test</h1>
                <button class="btn btn-outline-light">Reset</button>
            </div>
            <hr class="text-white">

            <form action="" method="POST">
                <div class="mt-4">
                    <!-- Question 1 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">1.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">When the phone rings you hurry to get to it first and don't hope someone else gets it.</label>
                        <select class="form-select" name="q1">
                            <option value="1">Nah</option>
                            <option value="2">Not really</option>
                            <option value="3">Kinda</option>
                            <option value="4">50/50</option>
                            <option value="5">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 2 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">2.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">You are more observant than introspective.</label>
                        <select class="form-select" name="q2">
                            <option value="1">Nah</option>
                            <option value="2">Not really</option>
                            <option value="3">Kinda</option>
                            <option value="4">50/50</option>
                            <option value="5">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 3 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">3.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">Is it worse to have your head in the clouds than be in a rut.</label>
                        <select class="form-select" name="q3">
                            <option value="1">Nah</option>
                            <option value="2">Not really</option>
                            <option value="3">Kinda</option>
                            <option value="4">50/50</option>
                            <option value="5">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 4 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">4.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">I often rely on my feelings when making decisions.</label>
                        <select class="form-select" name="q4">
                            <option value="1">Nah</option>
                            <option value="2">Not really</option>
                            <option value="3">Kinda</option>
                            <option value="4">50/50</option>
                            <option value="5">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 5 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">5.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">With people you are usually more firm than gentle.</label>
                        <select class="form-select" name="q5">
                            <option value="1">Nah</option>
                            <option value="2">Not really</option>
                            <option value="3">Kinda</option>
                            <option value="4">50/50</option>
                            <option value="5">Absolutely</option>
                        </select>
                    </div>
                </div>

                <!-- Score Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-outline-light btn-lg">Score</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
session_start();

require_once '../includes/db.php';
require_once '../includes/responces.php';
require_once '../includes/auth.php';
require_once '../includes/question.php';



if (!isLoggedIn() || $_SESSION['role'] !== 'user') {
    header("Location: ../pages/login.php");
    exit();
}

$questionObj = new Question($conn);
$questions = $questionObj->getAllQuestions();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [];
    for ($i = 1; $i <= 70; $i++) {
        $data['q' . $i] = $_POST['q' . $i] ?? 0;
    }

    $userid = $_SESSION['user_id'];
    $responseObj = new Responces($conn);

    if ($responseObj->storeResponces($data, $userid)) {
        echo "Response stored successfully!";
        header('location: dashboard.php');
        exit();
    } else {
        echo "Failed to store response!";
    }
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
            height: 80px;
            /* Adjust the logo size */
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
                <button id="resetButton" class="btn btn-outline-light">Reset</button>
            </div>
            <hr class="text-white">

            <form action="" method="POST">
                <div class="mt-4">
                    <!-- Loop through questions -->
                    <?php foreach ($questions as $key => $value) { ?>
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-white fs-5 me-3"><?php echo $key + 1; ?>.</span>
                            <label class="form-label text-white fs-5 flex-grow-1">
                                <?php echo htmlspecialchars($value['qtext'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <select class="form-select w-auto" name="q<?php echo $key; ?>">
                                <option value="0">Nah</option>
                                <option value="0">Not really</option>
                                <option value="0.5">Kinda</option>
                                <option value="1">50/50</option>
                                <option value="1">Absolutely</option>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <!-- Score Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-outline-light btn-lg">Score</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function saveToLocalStorage() {
            const selects = document.querySelectorAll('select');
            selects.forEach((select, index) => {
                select.addEventListener('change', () => {
                    localStorage.setItem(`q${index}`, select.value);
                });
            });
        }

        function restoreFromLocalStorage() {
            const selects = document.querySelectorAll('select');
            selects.forEach((select, index) => {
                const savedValue = localStorage.getItem(`q${index}`);
                if (savedValue !== null) {
                    select.value = savedValue;
                }
            });
        }

        function clearLocalStorage() {
            const form = document.querySelector('form');
            form.addEventListener('submit', () => {
                localStorage.clear();
            });
        }

        function resetForm() {
            const form = document.querySelector('form');
            form.reset();
            localStorage.clear();
        }

        document.getElementById('resetButton').addEventListener('click', resetForm);

        document.addEventListener('DOMContentLoaded', () => {
            saveToLocalStorage();
            restoreFromLocalStorage();
            clearLocalStorage();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
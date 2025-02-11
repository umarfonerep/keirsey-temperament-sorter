<?php
 session_start();
 
 require_once '../includes/db.php';
 require_once '../includes/responces.php';
 require_once '../includes/auth.php';


 if (!isLoggedIn() || $_SESSION['role'] !== 'user' ) {
    header("Location: ../pages/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'q1' => $_POST['q1'],
        'q2' => $_POST['q2'],
        'q3' => $_POST['q3'],
        'q4' => $_POST['q4'],
        'q5' => $_POST['q5'],
    ];

   
    $userid = $_SESSION['user_id'];
    $questionObj = new Responces($conn);

    if ($questionObj->storeResponces($data, $userid)) {
        echo "Response stored successfully!";
        header('location: dashboard.php');
    } else {
        echo "Failed to store response!";
    }

    die;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="gradient-custom">
    <div class="container py-5">
        <div class="card bg-dark text-white p-5" style="border-radius: 1rem;">

            <!-- Heading with Reset Button -->
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="fw-bold text-uppercase text-start mb-0">Keirsey Temperament Test</h1>
                <button class="btn btn-outline-light">Reset</button>
            </div>
            <hr class="text-white"> <!-- Border line after heading -->
            <form action="" method="POST">
                <div class="mt-4">
                    <!-- Question 1 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">1.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">When the phone rings you hurry to get to it first and don't hope someone else gets it.</label>
                        <select class="form-select w-auto" name="q1">
                            <option value="0">Nah</option>
                            <option value="0">Not really</option>
                            <option value="0.5">Kinda</option>
                            <option value="1">50/50</option>
                            <option value="1">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 2 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">2.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">You are more observant than introspective.</label>
                        <select class="form-select w-auto" name="q2">
                            <option value="0">Nah</option>
                            <option value="0">Not really</option>
                            <option value="0.5">Kinda</option>
                            <option value="1">50/50</option>
                            <option value="1">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 3 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">3.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">Is it worse to have your head in the clouds than be in a rut.</label>
                        <select class="form-select w-auto" name="q3">
                            < <option value="0">Nah</option>
                                <option value="0">Not really</option>
                                <option value="0.5">Kinda</option>
                                <option value="1">50/50</option>
                                <option value="1">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 4 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">4.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">I often rely on my feelings when making decisions.</label>
                        <select class="form-select w-auto" name="q4">
                            <option value="0">Nah</option>
                            <option value="0">Not really</option>
                            <option value="0.5">Kinda</option>
                            <option value="1">50/50</option>
                            <option value="1">Absolutely</option>
                        </select>
                    </div>

                    <!-- Question 5 -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-white fs-5 me-3">5.</span>
                        <label class="form-label text-white fs-5 flex-grow-1">With people you are usually more firm than gentle.</label>
                        <select class="form-select w-auto" name="q5">
                            <option value="0">Nah</option>
                            <option value="0">Not really</option>
                            <option value="0.5">Kinda</option>
                            <option value="1">50/50</option>
                            <option value="1">Absolutely</option>
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
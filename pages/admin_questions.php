<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/question.php';
require_once '../includes/auth.php';
 if (!isLoggedIn() || $_SESSION['role'] !== 'admin' ) {
    header("Location: ../pages/login.php");
    exit();
}

$question = new Question($conn);
$questions = $question->getAllQuestions();
?>


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
        .nav-item{
            margin-right: 1.5rem;
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
        .btn-logout {
            background-color: #F77F2E;
            color: white;
            /* border: 2px solid white; */
        }

        .btn-logout:hover {
            background-color: black;
            color: white;
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
<?php
include 'navbar.php';
?>

    <!-- Questions Section -->
    <div class="container mt-5">
        <h2 class="text-white">Manage Questions</h2>
        <table class="table table-bordered table-light mt-3">
            <thead>
                <tr>
                    <th>Question NO</th>
                    <th>Question</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?php echo $question['qid']; ?></td>
                        <td><?php echo $question['qtext']; ?></td>
                        <td><a href="question-edit.php?id=<?php echo $question['qid']; ?>" class="btn btn-warning">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</nav>


<!-- Footer (Sticks to Bottom) -->
<footer class="footer mt-auto">
    <div class="container">
        &copy; 2025 Keirsey Temperament Test. All Rights Reserved.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
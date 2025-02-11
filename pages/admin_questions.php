<?php
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
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.html">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="questions-edit.php">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_results.php">Results</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Questions Section -->
    <div class="container mt-5">
        <h2 class="text-white">Manage Questions</h2>
        <table class="table table-bordered table-light mt-3">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?php echo $question['qtext']; ?></td>
                        <td><a href="question-edit.php?id=<?php echo $question['qid']; ?>" class="btn btn-warning">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
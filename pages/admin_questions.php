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
    <link href="../style.css" rel="stylesheet">
    
</head>

<body>

<!-- Navbar -->
<?php
include 'navbar.php';
?>

    <!-- Questions Section -->
    <div class="container mt-5">
        <h1 class="">Manage Questions</h1>
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
                        <td><a href="question-edit.php?id=<?php echo $question['qid']; ?>" class="btn edit-btn">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</nav>
<!-- Footer (Sticks to Bottom) -->
<?php 
include 'footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
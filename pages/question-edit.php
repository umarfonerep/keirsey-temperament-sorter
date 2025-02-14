<?php
session_start();
include '../includes/db.php';
require_once '../includes/question.php';
require_once '../includes/auth.php';
 if (!isLoggedIn() || $_SESSION['role'] !== 'admin' ) {
    header("Location: ../pages/login.php");
    exit();
}
$id = $_GET['id'];
$questionObj = new Question($conn);
$question = $questionObj->editQuestion($id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heading = $_POST['heading'];
    $questionObj->updateQuestion($heading, $id);
    header("Location: admin_questions.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet"> <!-- Custom styles if needed -->
</head>
<body>
    <!-- Navbar -->
<?php
include 'navbar.php';
?>
   <!-- Results Section -->
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 800px; width: 100%;">
        <div class="card-body">
            <h2 class="text-center text-primary mb-4">Update Question</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Question</label>
                    <input type="text" class="form-control" name="heading"
                        value="<?php echo htmlspecialchars($question[0]['qtext']); ?>">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
include '../includes/auth.php';
include '../includes/db.php';
include '../includes/results.php';
include '../includes/responces.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'user') {
    header("Location: ../pages/login.php");
    exit();
}

$userid = $_SESSION['user_id'];

$responces = new Responces($conn);
$responces_question = $responces->getReponces($userid);

$resultsobj = new Results($conn);
$resultdatas = (!empty($resultsobj->getDataByUserId($userid))) ? $resultsobj->getDataByUserId($userid) : [];
// var_dump($resultdatas);
// die;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .table thead {
            background-color: #1E7AC2 !important;
            color: white;
        }
        .btn-custom {
            width: 200px;
            margin: 10px;
            border: 2px solid #1E7AC2;
            color: black;

        }
        .btn-custom:hover {
            background-color: #F77F2E;
            color: white;
            border: 2px solid #F77F2E;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
<?php
include 'navbar.php';
?>

    <!-- Dashboard Content -->
    <div class="container-content">
        <h1>Keirsey Temperament Test</h1>
        <div class="table-responsive">
            <?php if (!empty($resultdatas)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #1E7AC2;">
                            <th>Type</th>
                            <th>Group</th>
                            <th>Aspect</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultdatas as $resultdata): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($resultdata["personality_type"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($resultdata["result_group"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($resultdata["aspects"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($resultdata['description_links'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                                        <?php echo htmlspecialchars($resultdata["description_links"], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

                <a href="test.php"><button class="btn btn-custom">Retake Test</button></a>
                <a href="share_result.php"><button class="btn btn-custom text-white btn-primary">Share Result</button></a>

            <?php else: ?>

                <a href="test.php"><button class="btn btn-custom bg-color">Take Test</button></a>
            <?php endif; ?>

        </div>
    </div>

<!-- footer -->
    <footer class="footer mt-auto">
    <div class="container">
        &copy; 2025 Keirsey Temperament Test. All Rights Reserved.
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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


if (!empty($responces_question) && isset($responces_question[0]['question_responce'])) {
    $responses_encode = json_decode($responces_question[0]['question_responce'], true);
} else {
    $responses_encode = []; 
}

$resultsobj = new Results($conn);
$resultdatas = (!empty($responses_encode)) ? $resultsobj->process($responses_encode, $userid) : [];
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
        .table thead {
            background-color: #1E7AC2 !important;
            color: white;
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
            background-color: black;
            color: white;
        }

        .container-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 85vh;
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
        }

        .bg-color {
            background-color: #1E7AC2;
            color: white !important;
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
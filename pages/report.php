<?php
session_start();
include '../includes/db.php';
include '../includes/results.php';
include '../includes/auth.php';
date_default_timezone_set('UTC');
$conn->query("SET time_zone = '+00:00';");

$username = "";
$userResultData = [];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Fetch data using ID
    $id = intval($_GET['id']);
    $query = "SELECT username, first_name , last_name FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $resultsobj = new Results($conn);
        $userResultData = $resultsobj->getDataByUserId($id);
    }
}

if (isset($_GET['token']) && empty($userResultData)) {
    // Fetch data using Token only if userResultData is empty
    $token = $_GET['token'];
    $query = "SELECT user_id FROM result_tokens WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        $query = "SELECT username, first_name , last_name FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $resultsobj = new Results($conn);
            $userResultData = $resultsobj->getDataByUserId($user_id);
        }
    }
}

if (empty($userResultData)) {
    die("No valid user found for the provided ID or Token.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keirsey Temperament Test Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F9FA;
            color: black;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            text-align: center;
            padding: 15px;
        }

        .card {
            width: 100%;
            max-width: 100%;
            /* Keeps it well-sized for desktops */
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo-container img {
            max-width: 120px;
            height: auto;
        }

        .heading {
            font-size: 24px;
            font-weight: bold;
            color: #1E7AC2;
            margin-bottom: 15px;
        }

        .table-responsive {
            margin-top: 10px;
        }

        .table thead {
            background-color: #1E7AC2;
            color: white;
        }

        .cta-text {
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }

        .signup-link {
            font-size: 14px;
            margin-top: 8px;
        }

        .signup-link a {
            color: #1E7AC2;
            font-weight: bold;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                padding: 15px;
            }

            .heading {
                font-size: 20px;
            }

            .table {
                font-size: 14px;
            }

            .cta-text {
                font-size: 14px;
            }

            .signup-link {
                font-size: 12px;
            }

            .logo-container img {
                max-width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container-content py-5">
        <div class="card">
            <!-- Logo Section -->
            <div class="logo-container">
                <img src="../assets/LOGO.png" alt="Logo">
            </div>
            <!-- Page Heading -->
            <h1 class="heading">Keirsey Temperament Test Report </h1>
            <!-- Results Table -->
            <div class="table-responsive ">
                <table class="table table-bordered report-table">
                    <thead>
                        <tr>
                            <th class='text-start'>Username</th>
                            <th class='text-start'>Full Name</th>
                            <th class='text-start'>Type</th>
                            <th>Group</th>
                            <th>Aspect</th>
                            <th>Discriptor</th>
                            <th>Displayed Behaviours</th>
                            <th>Carriers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userResultData  as $resultdata): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($first_name,  ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($last_name,  ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($resultdata["personality_type"], ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td><?php echo htmlspecialchars($resultdata["result_group"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($resultdata["aspects"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($resultdata["descriptor"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td data-label="Displayed Behaviours">
                                    <div class="description-box">
                                        <span><?php echo nl2br(htmlspecialchars($resultdata["displayed_behaviours"])); ?></span>
                                    </div>
                                </td>
                                <td data-label="Careers">
                                    <div class="description-box">
                                        <span><?php echo nl2br(htmlspecialchars($resultdata["careers"])); ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Call to Action -->
            <p class="cta-text">Wanna give Keirsey Temperament Test?</p>
            <p class="signup-link">
                <a href="signup.php">Sign up here</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
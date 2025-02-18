<?php
session_start();
include '../includes/db.php';
include '../includes/results.php';
include '../includes/auth.php';

date_default_timezone_set('UTC');
$conn->query("SET time_zone = '+00:00';");

if (!isset($_GET['token'])) {
    die("Invalid request. Token is missing.");
}
// Fetch data base on token
$token = $_GET['token'];
$query = "SELECT user_id, expiry FROM result_tokens WHERE token = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Invalid or expired token.";
}
$row = $result->fetch_assoc();
// Fetch username
$user_id = $row['user_id'];
$query = "SELECT username FROM users WHERE id = ?"; 
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id); 
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username']; 
} else {
    echo "No user found with ID: " . $user_id; 
}
// Fetch result data
$resultsobj = new Results($conn);
$userResultData = (!empty($resultsobj->getDataByUserId($user_id))) ? $resultsobj->getDataByUserId($user_id) : [];


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
            background-color: #f8f9fa;
            color: black;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 60%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .heading {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #1E7AC2;
            margin-bottom: 20px;
        }

        .report-table {
            margin-top: 10px;
        }

        /* Results Table */
        .table thead {
            background-color: #1E7AC2;
            color: white;
        }

        .footer {
            background-color: #1E7AC2;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
            width: 100%;
        }

        .cta-text {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .signup-link {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }

        .signup-link a {
            color: #1E7AC2;
            font-weight: bold;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container-content">
        <div class="card">
            <!-- Page Heading -->
            <h1 class="heading">Keirsey Temperament Test Report </h1>

            <!-- Results Table (Same as `admin_results.php`) -->
            <table class="table table-bordered report-table">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Type</th>
                        <th>Group</th>
                        <th>Aspect</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userResultData  as $resultdata): ?>
                        <tr><td><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></td>
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
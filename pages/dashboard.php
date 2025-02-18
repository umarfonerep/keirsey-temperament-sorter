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
        
       /* Button Styling */
.btn-custom {
    width: 200px;
    margin: 10px;
    border: 2px solid #1E7AC2;
    color: black;
    transition: all 0.3s ease-in-out;
}

.btn-custom:hover {
    background-color: #F77F2E;
    color: white;
    border: 2px solid #F77F2E;
}

/* Table Styling */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
    word-wrap: break-word;
    white-space: normal;
    text-align: center;
}

.table th {
    background-color: #1E7AC2 !important;
    color: white !important;
    text-align: center;
}

.table td {
    vertical-align: middle;
}

/* Description Box Styling */
.description-box {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
}

.desc-title {
    font-size: 16px;
    font-weight: bold;
    color: #1E7AC2;
}

/* Footer Styling */
.footer {
    background-color: #1E7AC2;
    color: white;
    padding: 10px 0;
    text-align: center;
    font-size: 14px;
    width: 100%;
    margin-top: 20px;
}
.col-width{
    width: 12%;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .container-content {
        padding: 10px;
    }

    .table {
        table-layout: auto;
    }

    .table th, 
    .table td {
        font-size: 14px;
        padding: 8px;
    }

    .btn-custom {
        width: 100%;
        font-size: 14px;
    }
}


        
    </style>
</head>

<body>

    <!-- Navbar -->
<?php
include 'navbar.php';
?>

    <!-- Dashboard Content -->
    <div class="container-content container">
        <h1>Keirsey Temperament Test</h1>
        <div class="table-responsive">
            <?php if (!empty($resultdatas)): ?>
                <table class="table table-bordered table-responsive">
                <thead>
                        <tr style="background-color: #1E7AC2 !important; color: white !important;">
                            <th>Type</th>
                            <th>Group</th>
                            <th>Aspect</th>
                            <th>Displayed Behaviours</th>
                            <th>Carriers</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultdatas as $resultdata): ?>
                            <tr>
                                <td class="col-width"><?php echo htmlspecialchars($resultdata["personality_type"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="col-width"><?php echo htmlspecialchars($resultdata["result_group"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="col-width"><?php echo htmlspecialchars($resultdata["aspects"], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                  <div class="description-box">
                                   <p>Outgoing, social, disorganized, easily talked into doing silly things, spontaneous, wild and crazy, acts without thinking, good at getting people to have fun, pleasure seeking, irresponsible, physically affectionate, risk taker, thrill seeker, likely to have or want a tattoo, adventurous, unprepared, attention seeking, hyperactive, irrational, loves crowds, rule breaker, prone to losing things, seductive, easily distracted, open, revealing, comfortable in unfamiliar situations, attracted to strange things, non-punctual, likes to stand out, likes to try new things, fun seeker, unconventional, energetic, impulsive, empathetic, dangerous, loving, attachment prone, prone to fantasy.</p>
                                   </div>
                                </td>
                                <td>
                                  <div class="description-box">
                                   <p>Performer, actor, entertainer, songwriter, musician, filmmaker, comedian, radio broadcaster/DJ, some job related to theater/drama, poet, music journalist, work in fashion industry, singer, movie producer, playwright, bartender, comic book author, work in television, dancer, artist, record store owner, model, freelance artist, teacher (art, drama, music), writer, painter, massage therapist, costume designer, choreographer, make-up artist.</p>
                                   </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

                <div class="d-flex justify-content-between w-100">
    <!-- Left-aligned Buttons -->
    <div>
        <a href="test.php"><button class="btn btn-custom">Retake Test</button></a>
        <a href="share_result.php"><button class="btn btn-custom text-white btn-primary">Share Result</button></a>
    </div>

    <!-- Right-aligned Button -->
    <div>
    <a href="test.php"><button class="btn btn-custom">Show Graph</button></a>
    <a href="sub-types.php"><button class="btn btn-custom text-white btn-primary">See More Personalities</button></a>
    </div>
</div>


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
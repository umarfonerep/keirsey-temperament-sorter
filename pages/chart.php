<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/responces.php';
require_once '../includes/results.php';
// Fetch user responses
$responseObj = new Responces($conn);
$resultsObj = new Results($conn);
$userid = $_SESSION['user_id'];
$responces_question = $responseObj->getReponces($userid);
// Decode responses
$responses_encode = !empty($responces_question) && isset($responces_question[0]['question_responce'])
    ? json_decode($responces_question[0]['question_responce'], true)
    : [];
// Process responses to get MBTI scores
$taritsresult = $resultsObj->process($responses_encode, $userid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your MBTI Results</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Custom Styles */
        .container {
            margin-top: 30px;
        }
        .graph-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .details-container {
            text-align: left;
            max-width: 350px;
        }
        .list-style-none {
            list-style: none;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container text-center">
        <h1>Typology Graph</h1>
        <!-- Graph and Details Container -->
        <div class="graph-container">
            <!-- Graph Image (No Card Styling) -->
            <div>
                <img src="../includes/generate_graph.php" alt="MBTI Scores Graph" class="img-fluid">
            </div>
            <!-- Details on the Right -->
            <div class="details-container">
                <ul class="list-style-none">
                    <li><strong>E = EXTROVERSION</strong></li>
                    <li><strong>I = Introversion</strong> </li>
                    <li><strong>S = Sensing</strong></li>
                    <li><strong>N = Intuition</strong></li>
                    <li><strong>T = Thinking</strong></li>
                    <li><strong>F = Feeling</strong></li>
                    <li><strong>J = Judging</strong></li>
                    <li><strong>p = Perceiving</strong></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>







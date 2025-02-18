
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
    <title>MBTI Results</title>
</head>
<body>
    <h1>Your MBTI Results</h1>
    <!-- <p>Here are your scores:</p>
    <pre><?php print_r($taritsresult); ?></pre> -->

    <h2>Graphical Representation</h2>
    <img src="../includes/generate_graph.php" alt="MBTI Scores Graph">
</body>
</html>
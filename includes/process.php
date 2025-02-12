<?php

use LDAP\Result;

session_start();
include '../includes/db.php';
include '../includes/responces.php';
include '../includes/results.php';
 
$userid = $_SESSION['user_id'];

$responces = new Responces($conn);
$responces_question = $responces->getReponces($userid);
$responses_encode = json_decode($responces_question[0]['question_responce'], true);


$traits = ['E' => 'I', 'S' => 'N', 'T' => 'F', 'J' => 'P'];
$scores = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];

foreach ($responses_encode as $question => $value) {
    $questionNum = (int)str_replace("q", "", $question);
    $traitKeys = array_keys($traits);
    $traitIndex = ($questionNum - 1) % 4;
    $trait1 = $traitKeys[$traitIndex];
    $trait2 = $traits[$trait1];

    $value = (float)$value;
    $scores[$trait1] += $value;
    $scores[$trait2] += (1 - $value);
}

$personalityType = '';
$personalityType .= ($scores['E'] > $scores['I']) ? 'E' : 'I';
$personalityType .= ($scores['S'] > $scores['N']) ? 'S' : 'N';
$personalityType .= ($scores['T'] > $scores['F']) ? 'T' : 'F';
$personalityType .= ($scores['J'] > $scores['P']) ? 'J' : 'P';

var_dump($personalityType);

$result = new Results($conn);
$storeResul = $result->storeResults($personalityType, $userid);

?>
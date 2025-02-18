<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/responces.php';
require_once '../includes/results.php';
require_once __DIR__ . '/../jpgraph/src/jpgraph.php';
require_once __DIR__ . '/../jpgraph/src/jpgraph_bar.php';


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

// MBTI scores
$scores = [
    'E' => $taritsresult['E'],
    'I' => $taritsresult['I'],
    'S' => $taritsresult['S'],
    'N' => $taritsresult['N'],
    'T' => $taritsresult['T'],
    'F' => $taritsresult['F'],
    'J' => $taritsresult['J'],
    'P' => $taritsresult['P']
];

$graph = new Graph(600, 400);
$graph->SetScale('textlin'); 
$graph->SetBox(false); 

// X-axis setup
$graph->xaxis->SetTickLabels(array_keys($scores)); 
$graph->xaxis->SetLabelAngle(45); 

// Bar plot create karein
$barplot = new BarPlot(array_values($scores));
$barplot->SetColor('white'); 
$barplot->SetFillColor('#4CAF50'); 

$graph->Add($barplot);

$graph->Stroke();
?>
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
    ? json_decode($responces_question[0]['question_responce'], true) : [];
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
// Separate scores into pairs with spacing
$barValues = [];
$xAxisLabels = [];
foreach (array_chunk($scores, 2, true) as $pair) {
    foreach ($pair as $key => $value) {
        $barValues[] = $value;
        $xAxisLabels[] = "$key ($value)";
    }
    $barValues[] = 0; // Space between pairs
    $xAxisLabels[] = ''; // Empty label for spacing
}
// Create the graph
$graph = new Graph(700, 500);
$graph->SetScale('textlin');
$graph->SetBox(false);
$graph->SetMargin(50, 30, 50, 80);
// X-axis setup (Bold Alphabets)
$graph->xaxis->SetTickLabels($xAxisLabels);
$graph->xaxis->SetLabelAngle(0);
$graph->xaxis->SetFont(FF_FONT1, FS_BOLD);
$graph->xaxis->SetLabelMargin(10);
// Bar colors
$barColors = [
    '#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4',
    '#FFEEAD', '#D4A5A5', '#B8B8F3', '#FFA577'
];
// Expand colors to match dummy bars
$expandedColors = [];
foreach (array_chunk($barColors, 2) as $pair) {
    foreach ($pair as $color) {
        $expandedColors[] = $color;
    }
    $expandedColors[] = 'white'; // Dummy bar color
}
// Create bar plot
$barplot = new BarPlot($barValues);
$barplot->SetFillColor($expandedColors);
$barplot->SetColor('black@0.5');
// Add bar plot to graph
$graph->Add($barplot);
// Set graph title
$graph->title->SetFont(FF_FONT1, FS_BOLD);
// Output the graph
$graph->Stroke();
?>










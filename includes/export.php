<?php
session_start();
require '../vendor/autoload.php'; // Load PhpSpreadsheet
include '../includes/auth.php';
include '../includes/db.php';
include '../includes/responces.php';
include '../includes/results.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$resultsobj = new Results($conn);
$responseObj = new Responces($conn);

// Check if user is logged in
if (!isLoggedIn() || $_SESSION['role'] !== 'user') {
    header("Location: ../pages/login.php");
    exit();
}
$userid = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch a single row
    $row = $result->fetch_assoc();
    $stmt->close();
}


$userResult = $resultsobj->getDataByUserId($userid);
$responces_question = $responseObj->getReponces($userid);

$responses_encode = !empty($responces_question) && isset($responces_question[0]['question_responce']) 
    ? json_decode($responces_question[0]['question_responce'], true) 
    : [];

// Process responses to get MBTI scores
$traitsResult = $resultsobj->process($responses_encode, $userid);

if (empty($userResult)) {
    die("No results found to export.");
}
// Create new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Username')
    ->setCellValue('A2', 'Type')
    ->setCellValue('A3', 'Group')
    ->setCellValue('A4', 'Aspect')
    ->setCellValue('A5', 'Displayed Behaviours')
    ->setCellValue('A6', 'Careers');

// Insert User Data
$data = $userResult[0];
$sheet->setCellValue('B1', $row['username']);
$sheet->setCellValue('B2', $data["personality_type"]);
$sheet->setCellValue('B3', $data["result_group"]);
$sheet->setCellValue('B4', $data["aspects"]);
$sheet->setCellValue('B5', $data["displayed_behaviours"]);
$sheet->setCellValue('B6', $data["careers"]);


// Insert Traits Scores into Excel
$rowNum = 9; // Start from row 9
foreach ($traitsResult as $trait => $score) {
    $sheet->setCellValue('A' . $rowNum, $trait);
    $sheet->setCellValue('B' . $rowNum, $score);
    $rowNum++; // Move to the next row
}
$boldBlueStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '0000FF'], // Blue Color
    ],
];

$sheet->getStyle('A1:A14')->applyFromArray($boldBlueStyle);
 // Make Trait Headers Bold Too
$filename = "User_Result.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();

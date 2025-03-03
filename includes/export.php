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
$query = "SELECT username, first_name, last_name FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
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

$fullname = $row['first_name'] . ' ' . $row['last_name'];
// Create new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// Set Header Rows
$sheet->setCellValue('A1', 'Username')
    ->setCellValue('A2', 'Full Name')
    ->setCellValue('A3', 'Type')
    ->setCellValue('A4', 'Group')
    ->setCellValue('A5', 'Aspect')
    ->setCellValue('A6', 'Displayed Behaviours')
    ->setCellValue('A7', 'Careers');
// Insert User Data
$data = $userResult[0];
$sheet->setCellValue('B1', $row['username']);
$sheet->setCellValue('B2', $fullname);
$sheet->setCellValue('B3', $data["personality_type"]);
$sheet->setCellValue('B4', $data["result_group"]);
$sheet->setCellValue('B5', $data["aspects"]);
$sheet->setCellValue('B6', $data["displayed_behaviours"]);
$sheet->setCellValue('B7', $data["careers"]);
// Adjust Column Width to Prevent Excessive Wrapping
$sheet->getColumnDimension('B')->setWidth(50); // Approx half screen width
$sheet->getStyle('B1:B7')->getAlignment()->setWrapText(true);
// Auto-adjust row height for readability
foreach (range(1, 7) as $rowNum) {
    $sheet->getRowDimension($rowNum)->setRowHeight(-1); // Auto height
}
// Insert Traits Scores into Excel
$rowNum = 8; // Start from row 9
foreach ($traitsResult as $trait => $score) {
    $sheet->setCellValue('A' . $rowNum, $trait);
    $sheet->setCellValue('B' . $rowNum, $score);
    $rowNum++; // Move to the next row
}
// Apply Bold and Blue Style to Header
$boldBlueStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '0000FF'], // Blue Color
    ],
];
$sheet->getStyle('A1:A15')->applyFromArray($boldBlueStyle);
// Set Headers for File Download
$filename = "User_Result.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();

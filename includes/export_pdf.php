<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../vendor/autoload.php'; // Load MPDF
include '../includes/auth.php';
include '../includes/db.php';
include '../includes/results.php';
include '../includes/responces.php';
    use Mpdf\Mpdf;
// Check if user is logged in and is a normal user
if (!isLoggedIn() || $_SESSION['role'] !== 'user') {
    header("Location: ../pages/login.php");
    exit();
}
$userid = $_SESSION['user_id'];
$results = new Results($conn);
$responseObj = new Responces($conn);
$userResult = $results->getDataByUserId($userid);
$query = "SELECT username,first_name,last_name FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
$responces_question = $responseObj->getReponces($userid);
$responses_encode = !empty($responces_question) && isset($responces_question[0]['question_responce'])
    ? json_decode($responces_question[0]['question_responce'], true)
    : [];
if (!method_exists($results, 'process')) {
    die("Error: Method 'process' not found in Results class.");
}
$traitsResult = $results->process($responses_encode, $userid);
$resultdatas = $userResult[0] ?? []; // Get first result safely
// Securely Extract User Data
$username = htmlspecialchars( $row["username"] ?? "N/A");
$first_name = htmlspecialchars( $row["first_name"] ?? "N/A");
$last_name = htmlspecialchars( $row["last_name"] ?? "N/A");
$personality_type = htmlspecialchars($resultdatas["personality_type"] ?? "N/A");
$result_group = htmlspecialchars($resultdatas["result_group"] ?? "N/A");
$aspects = htmlspecialchars($resultdatas["aspects"] ?? "N/A");
$displayed_behaviours = htmlspecialchars($resultdatas["displayed_behaviours"] ?? "N/A");
$careers = htmlspecialchars($resultdatas["careers"] ?? "N/A");
// Extract Scores Properly
$scoresHTML = "";
if (!empty($traitsResult) && is_array($traitsResult)) {
    foreach ($traitsResult as $key => $value) {
        if (is_numeric($value)) {
            $safeKey = htmlspecialchars($key);
            $safeValue = htmlspecialchars($value);
            $scoresHTML .= "
            <tr>
                <th style='background-color:#f2f2f2;'>{$safeKey}</th>
                <td>{$safeValue}</td>
            </tr>";
        }
    }
}
// Check if MPDF is properly loaded
if (!class_exists('Mpdf\Mpdf')) {
    die("Error: MPDF library is missing. Run 'composer require mpdf/mpdf'.");
}
// Initialize MPDF
$mpdf = new Mpdf();
// Define Logo Paths
$logoPath1 = '../assets/LOGO.png'; // Adjust the path as needed
$logoPath2 = '../assets/logo2.png'; // Adjust the path as needed
// Generate HTML for PDF with logos
$html = "
    <div style='text-align:center; margin-bottom: 20px;'>
        <img src='{$logoPath1}' style='width: 220px;  margin-right: 20px;'>
        <img src='{$logoPath2}' style='width: 120px; '>
    </div>
    <h2 style='text-align:center; font-family: Arial, sans-serif;'>User Personality Test Result</h2>
    <table border='1' cellpadding='8' cellspacing='0' width='100%' style='border-collapse: collapse; font-family: Arial, sans-serif;'>
        <tr><th style='background-color:#f2f2f2;'>User Name</th><td>{$username}</td></tr>
        <tr><th style='background-color:#f2f2f2;'>Full Name</th><td>{$first_name} {$last_name}</td></tr>
        <tr><th style='background-color:#f2f2f2;'>Type</th><td>{$personality_type}</td></tr>
        <tr><th style='background-color:#f2f2f2;'>Group</th><td>{$result_group}</td></tr>
        <tr><th style='background-color:#f2f2f2;'>Aspect</th><td>{$aspects}</td></tr>
        <tr><th style='background-color:#f2f2f2;'>Displayed Behaviours</th><td>{$displayed_behaviours}</td></tr>
        <tr><th style='background-color:#f2f2f2;'>Careers</th><td>{$careers}</td></tr>
        <tr><th style='background-color:#f2f2f2;'></th><td>{$scoresHTML}</td></tr>
    </table>
";
// Write HTML to PDF
$mpdf->WriteHTML($html);
// Output PDF for Download
$filename = "User_Result.pdf";
$mpdf->Output($filename, "D");
exit();







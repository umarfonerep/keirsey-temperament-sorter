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
$query = "SELECT username, first_name, last_name FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
$fullname = $row['first_name'] . ' ' . $row['last_name'];
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
            width: 170px;
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
        }

        .table th {
            background-color: #1E7AC2 !important;
            color: white !important;
            text-align: center;
        }


        /* Description Box Styling */
        .description-box {
            background-color: #F8F9FA;
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

        .col-width {
            width: 12%;
        }

        .take-test-btn {
            margin-left: 41%;
        }

        .dropdown-item:hover {
            background-color: #F77F2E;
            color: white;
        }

        @media (max-width: 768px) {
            .table {
                display: block;
                width: 100%;
            }

            .btn-custom {
                width: 100px;
                height: 50px;
                font-size: 11px;
            }

            .table thead {
                display: none;
            }

            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                background: #F9F9F9;
                padding: 10px;
                border-radius: 5px;
            }

            .table td {
                text-align: left;
                /* Align content to the left */
                padding: 8px;
                position: relative;
                display: flex;
                flex-direction: column;
                /* Stack text below */
            }

            .table td::before {
                content: attr(data-label);
                /* Show header as label */
                font-weight: bold;
                color: white;
                background-color: #1E7AC2;
                text-align: center;
                padding: 8px;
                display: block;
                border-radius: 5px;
            }

            .description-box {
                background-color: #F8F9FA;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ddd;
                margin-top: 5px;
            }

            @media(max-width: 1050px) {
                .container-content {
                    height: 100vh !important;
                }

                .h-100 {
                    height: 100vh !important;
                }
            }

            @media(max-width: 568px) {
                .container-content {
                    height: 100vh !important;
                }

            }
        }

        @page {
            size: A3;
            margin: 20mm;
            /* Optional: Adjust the margin as needed */
        }

        @media print {

            .btn-custom,
            .btn-group {
                display: none !important;
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
    <div class="container-content container-fluid py-5">
        <h1>Keirsey Temperament Test</h1>
        <div class="table-responsive">
            <?php if (!empty($resultdatas)): ?>
                <div id='printArea'>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-width">Usename</th>
                                <th class="col-width">Full Name</th>
                                <th class="col-width">Type</th>
                                <th class="col-width">Group</th>
                                <th class="col-width">Aspect</th>
                                <th>Descriptor</th>
                                <th>Displayed Behaviours</th>
                                <th>Careers</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultdatas as $resultdata): ?>
                                <tr>
                                    <td data-label="Type">
                                        <span><?php echo htmlspecialchars($row['username']); ?></span>
                                    </td>
                                    <td data-label="Type">
                                        <span><?php echo htmlspecialchars($fullname); ?></span>
                                    </td>
                                    <td data-label="Type">
                                        <span><?php echo htmlspecialchars($resultdata["personality_type"]); ?></span>
                                    </td>
                                    <td data-label="Group">
                                        <span><?php echo htmlspecialchars($resultdata["result_group"]); ?></span>
                                    </td>
                                    <td data-label="Aspect"><span><?php echo htmlspecialchars($resultdata["aspects"]); ?></span>
                                    </td>
                                    <td data-label="Descriptor">
                                        <?php echo htmlspecialchars($resultdata["descriptor"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td data-label="Displayed Behaviours">
                                        <div class="description-box">
                                            <span><?php echo nl2br(htmlspecialchars($resultdata["displayed_behaviours"])); ?></span>
                                        </div>
                                    </td>
                                    <td data-label="Careers">
                                        <div class="description-box">
                                            <span><?php echo nl2br(htmlspecialchars($resultdata["careers"])); ?></span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <!-- Left-aligned Buttons -->
                    <div>
                        <a href="test.php"><button class="btn btn-custom">Retake Test</button></a>
                        <a href="share_result.php"><button class="btn btn-custom text-white btn-primary">Share
                                Result</button></a>
                    </div>

                    <div class="btn-group">
                        <button class="btn btn-custom btn-success text-white dropdown-toggle" id="exportDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Export As
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="exportDropdown">
                            <li><a class="dropdown-item" href="../includes/export.php">In Excel</a></li>
                            <li><a class="dropdown-item" href="../includes/export_pdf.php">As PDF</a></li>
                        </ul>
                    </div>

                    <a class="btn btn-custom" onclick="printPageContent()">Print</a>
                    <!-- Right-aligned Button -->
                    <div>
                        <a href="chart.php"><button class="btn btn-custom">Show Graph</button></a>
                        <a href="sub-types.php"><button class="btn btn-custom text-white btn-primary">More
                                Personalities</button></a>
                    </div>
                </div>
            <?php else: ?>
                <a href="test.php"><button class="btn btn-custom bg-color take-test-btn">Take Test</button></a>
            <?php endif; ?>
        </div>
    </div>
    <!-- footer -->
    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printPageContent() {
            var content = document.getElementById("printArea").innerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print</title>
                    <style>
                        body { font-family: Arial, sans-serif; text-align: center; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #1E7AC2; color: white; }
                        @page { size: A3; margin: 20mm; }
                        .logo { display: flex;  justify-content: center; align-items: center; margin-bottom: 20px;  }
                        .logo-container { text-align: center; margin-bottom: 20px; }
                        .logo-container img { width: 150px; margin-top:-10px; }
                        .seclogo img { width: 90px; }
                        .print-header { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
                    </style>
                </head>
                <body>
                    <div class='logo'>
                    <div class="logo-container">
                        <img src="../assets/LOGO.png" alt="Logo">
                    </div>
                    <div class="seclogo">
                        <img src="../assets/logo2.png" alt="Logo" class="seclogo">
                    </div>
                    </div>
                    <div class="print-header">Keirsey Temperament Test</div>
                    ${content}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
</body>

</html>
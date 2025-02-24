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
$traitsResult = $resultsObj->process($responses_encode, $userid);
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Trait', 'Score', {
                    role: 'style'
                }, {
                    role: 'annotation'
                }, {
                    role: 'tooltip',
                    p: {
                        html: true
                    }
                }], // Annotation for top score

                ['E', <?php echo $traitsResult['E']; ?>, '#FF6B6B', '<?php echo $traitsResult['E']; ?>', '<b>Extroversion (E)</b>: <?php echo $traitsResult['E']; ?>'],
                ['I', <?php echo $traitsResult['I']; ?>, '#4ECDC4', '<?php echo $traitsResult['I']; ?>', '<b>Introversion (I)</b>: <?php echo $traitsResult['I']; ?>'],
                ['', 0, 'transparent', '', ''], // Gap

                ['S', <?php echo $traitsResult['S']; ?>, '#45B7D1', '<?php echo $traitsResult['S']; ?>', '<b>Sensing (S)</b>: <?php echo $traitsResult['S']; ?>'],
                ['N', <?php echo $traitsResult['N']; ?>, '#96CEB4', '<?php echo $traitsResult['N']; ?>', '<b>Intuition (N)</b>: <?php echo $traitsResult['N']; ?>'],
                ['', 0, 'transparent', '', ''], // Gap

                ['T', <?php echo $traitsResult['T']; ?>, '#FFEEAD', '<?php echo $traitsResult['T']; ?>', '<b>Thinking (T)</b>: <?php echo $traitsResult['T']; ?>'],
                ['F', <?php echo $traitsResult['F']; ?>, '#D4A5A5', '<?php echo $traitsResult['F']; ?>', '<b>Feeling (F)</b>: <?php echo $traitsResult['F']; ?>'],
                ['', 0, 'transparent', '', ''], // Gap

                ['J', <?php echo $traitsResult['J']; ?>, '#B8B8F3', '<?php echo $traitsResult['J']; ?>', '<b>Judging (J)</b>: <?php echo $traitsResult['J']; ?>'],
                ['P', <?php echo $traitsResult['P']; ?>, '#FFA577', '<?php echo $traitsResult['P']; ?>', '<b>Perceiving (P)</b>: <?php echo $traitsResult['P']; ?>']
            ]);

            var options = {
                chartArea: {
                    width: '80%',
                    height: '70%'
                },
                bars: 'vertical',
                colors: ['#1b9e77'],
                legend: {
                    position: "none"
                },
                tooltip: {
                    isHtml: true
                }, // Enable rich tooltips
                annotations: {
                    alwaysOutside: true
                } // Display score on top of bars
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>



    <style>
        .graph-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .details-container {
            text-align: left;
            max-width: 350px;
            padding-bottom: 3rem;
        }

        @media (max-width: 768px) {
            .details-container {
                max-width: 100%;
                text-align: center;
                padding-left: 26px;
            }
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container text-center py-5">
        <div class="d-flex justify-content-between align-items-center">
            <a href="dashboard.php" class="btn btn-outline-primary">Back</a>
            <h1 class="text-center flex-grow-1 mb-0">Typology Graph</h1>
        </div>

        <!-- Graph and Details Container -->
        <div class="graph-container">
            <!-- Graph Display -->
            <div id="chart_div" style="width: 800px; height: 500px;"></div>

            <!-- Details Table -->
            <div class="details-container">
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Trait</th>
                            <th>Meaning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>E</strong></td>
                            <td>Extroversion</td>
                        </tr>
                        <tr>
                            <td><strong>I</strong></td>
                            <td>Introversion</td>
                        </tr>
                        <tr>
                            <td><strong>S</strong></td>
                            <td>Sensing</td>
                        </tr>
                        <tr>
                            <td><strong>N</strong></td>
                            <td>Intuition</td>
                        </tr>
                        <tr>
                            <td><strong>T</strong></td>
                            <td>Thinking</td>
                        </tr>
                        <tr>
                            <td><strong>F</strong></td>
                            <td>Feeling</td>
                        </tr>
                        <tr>
                            <td><strong>J</strong></td>
                            <td>Judging</td>
                        </tr>
                        <tr>
                            <td><strong>P</strong></td>
                            <td>Perceiving</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <?php include 'footer.php'; ?>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
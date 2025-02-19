<?php
include '../includes/db.php';
include '../includes/data.php';

$dataobj = new Data($conn);
$getdata = $dataobj->getData();
// var_dump($getdata);
// die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sub type personalty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Grid Layout for Buttons */
        .button-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        /* Popup Background Overlay */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Popup Content Box */
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            position: relative;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        /* Close Button */
        .popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #F77F2E;
        }

        /* Popup Heading Styling */
        .popup-heading {
            font-size: 18px;
            font-weight: bold;
            color: #1E7AC2;
        }

        /* Center Two Divs Inside Popup */
        .popup-body {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 15px;
        }

        .popup-section {
            flex: 1;
            padding: 10px;
            background: #F8F9FA;
            border-radius: 5px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .button-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .popup-content {
                width: 90%;
            }

            .popup-body {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container mt-4">
        <h2 class="text-center">Personality Types</h2>
        <div class="button-grid">
            <?php foreach ($getdata as $key => $getdata): ?>
                <button class="btn btn-primary w-100" onclick="showPopup(
                '<?php echo $getdata['personality_type']; ?>',
                '<?php echo addslashes($getdata['displayed_behaviours']); ?>',
                '<?php echo addslashes($getdata['careers']); ?>',
                '<?php echo  addslashes($getdata['result_group']); ?>'
            )">
                    <?php echo $getdata['personality_type']; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Custom Popup (Initially Hidden) -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <h5 class="popup-title" id="popuptitle">Group</h5>
            <div class="popup-body">
                <div class="popup-section">
                    <h5 class="popup-heading" id="popupHeading1">Displayed Behaviours</h5>
                    <p id="popupText1"></p>
                </div>
                <div class="popup-section">
                    <h5 class="popup-heading" id="popupHeading2">Careers</h5>
                    <p id="popupText2"></p>
                </div>
            </div>
        </div>
    </div>
    <script>

        function showPopup(personalityType, displayedBehaviours, careers, result_group) {
            // Set the popup content
            document.getElementById("popupHeading1").innerText = "Displayed Behaviours";
            document.getElementById("popupText1").innerText = displayedBehaviours;
            document.getElementById("popupHeading2").innerText = "Careers";
            document.getElementById("popupText2").innerText = careers;
            document.getElementById("popuptitle").innerText = 'Group' + ' ' + result_group;

            // Show the popup
            document.getElementById("popupOverlay").style.display = "flex";
        }

        function closePopup() {
            // Hide the popup
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>
</body>

</html>
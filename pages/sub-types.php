<?php
include '../includes/db.php';
include '../includes/data.php';
$dataobj = new Data($conn);
$getdata = $dataobj->getData();
// Group the data by result_group
$groupedData = [];
foreach ($getdata as $item) {
    $groupedData[$item['result_group']][] = $item;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub Type Personality</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .button-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 40px;
        }
        .group-heading {
            margin-top: 30px;
            font-size: 22px;
            font-weight: bold;
            color: #1E7AC2;
        }
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
            padding: 10px;
            overflow-y: auto;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        .popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #F77F2E;
        }
        .popup-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }
        .popup-grid h5, .popup-title {
            color: #1E7AC2;
        }
        .popup-container {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #F9F9F9;
        }
        .group-description {
            color: black;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .button-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .popup-grid {
                grid-template-columns: 1fr;
            }
            .popup-content {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-4">
    <a href="dashboard.php" class="btn btn-outline-primary mb-3">Back</a>
    <h2 class="text-center">Personality Types</h2>
    <?php foreach ($groupedData as $group => $items): ?>
        <div class="group-heading text-center">
            Group <?php echo htmlspecialchars($group); ?> - <small class="text-black">(<?php echo htmlspecialchars($items[0]['descriptor']); ?>)</small></div>
        <div class="button-grid">
            <?php foreach ($items as $item): ?>
                <button class="btn btn-primary"
                    onclick="showPopup(
                        '<?php echo addslashes($item['personality_type']); ?>',
                        '<?php echo addslashes($item['displayed_behaviours']); ?>',
                        '<?php echo addslashes($item['careers']); ?>',
                        '<?php echo addslashes($item['result_group']); ?>'
                    )">
                    <?php echo htmlspecialchars($item['personality_type']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-content">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <h4 class="popup-title" id="popupTitle">Personality Type - Group</h4>
        <div class="popup-grid">
            <div class="popup-container">
                <h5>Displayed Behaviours</h5>
                <p id="popupText1"></p>
            </div>
            <div class="popup-container">
                <h5>Careers</h5>
                <p id="popupText2"></p>
            </div>
        </div>
    </div>
</div>
<script>
    function showPopup(personalityType, displayedBehaviours, careers, resultGroup) {
        document.getElementById("popupTitle").innerText = personalityType + " - Group " + resultGroup;
        document.getElementById("popupText1").innerText = displayedBehaviours;
        document.getElementById("popupText2").innerText = careers;
        document.getElementById("popupOverlay").style.display = "flex";
    }
    function closePopup() {
        document.getElementById("popupOverlay").style.display = "none";
    }
</script>
</body>
</html>







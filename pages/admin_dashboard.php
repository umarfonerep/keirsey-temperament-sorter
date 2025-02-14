<?php
include '../includes/auth.php';
include '../includes/db.php';
include '../includes/results.php';

$results = new Results($conn);
$data = $results->getAlldata();
$resultdatas = $data['results'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Keirsey Temperament Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../style.css">

</head>
<body>


<?php
include 'navbar.php';
?>
<!-- Admin Dashboard Content -->
<!-- Dashboard Content -->
<div class="container-content">
        <h1 class= "heading">Keirsey Temperament Test</h1>
   
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="background-color: #1E7AC2;">
                        <th>User Name</th>
                        <th>Personality Type</th>
                        <th>Group</th>
                        <th>Aspects</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultdatas as $resultdata): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($resultdata["username"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["personality_type"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["result_group"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($resultdata["aspects"], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php
      include 'footer.php'
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
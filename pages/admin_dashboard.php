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
<style>
    .result-container-content {
           flex-grow: 1;
        }
       .table thead {
           background-color: #1E7AC2;
           color: white;
        }
</style>
<?php
include 'navbar.php';
?>


<div class="container mt-5 result-container-content">
    <h2 class="text-center mb-4">Results</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
<<<<<<< HEAD
            <thead class="bgcolor">
                <tr>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Group</th>
                    <th>Aspect</th>
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

=======
    <thead> <!-- Changed class and added text-white -->
        <tr class="table-primary"> 
            <th>User Name</th>
            <th>Type</th>
            <th>Group</th>
            <th>Aspect</th>
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

>>>>>>> 88a8cca8d42deb8f30a4ab631b8116e2e40ffad5
    </div>
    <?php
      include 'footer.php'
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
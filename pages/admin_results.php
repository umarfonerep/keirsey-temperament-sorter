<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet"> <!-- Custom styles if needed -->
    <style>
       .result-container-content {
           flex-grow: 1;
        }
       .table thead {
           background-color: #1E7AC2;
           color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php
include 'navbar.php';
?>

<!-- Results Section -->
<div class="container mt-5 result-container-content">
    <h2 class="text-center mb-4">Results</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                   <th>User Name</th>
                    <th>Type</th>
                    <th>Group</th>
                    <th>Aspect</th>                
                  </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ehtisham</td>
                    <td>Extrovert</td>
                    <td>Social</td>
                    <td>Leadership</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer (Sticks to Bottom) -->
<footer class="footer mt-auto">
        <div class="container">
            <?php
            include 'footer.php';
            ?>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet"> <!-- Custom styles if needed -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style = "background-color: #1E7AC2;">
          <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="admin_dashboard.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="admin_questions.php">Questions</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="admin_results.php">Results</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Results Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Results</h2>
        <div class="table-responsive">
            <table class="table table-bordered";>
                <thead class="table-dark">
                    <tr style = "background-color: #1E7AC2;">
                        <th>Type</th>
                        <th>Group</th>
                        <th>Aspect</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Extrovert</td>
                        <td>Social</td>
                        <td>Leadership</td>
                        <td>Great at handling social situations.</td>
                    </tr>
                    <tr>
                        <td>Introvert</td>
                        <td>Reflective</td>
                        <td>Thoughtful</td>
                        <td>Prefers deep conversations over small talk.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

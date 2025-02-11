<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.html">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_questions.html">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_results.html">Results</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Results Section -->
    <div class="container mt-5">
        <h2 class="text-white">Results</h2>
        <form>
            <div class="mb-3">
                <label class="form-label text-black">Type</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label text-">Group</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Aspect</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Description</label>
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button class="btn btn-success">Save</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

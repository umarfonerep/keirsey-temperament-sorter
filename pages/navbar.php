<!-- Navbar -->
<!-- <?php 
session_start();
?> -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="../includes/dashboard.php"><img src="../assets/LOGO.png" alt="Logo" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    
                <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_questions.php">Questions</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="admin_results.php">Results</a></li> -->
                <?php } ?>
                <li><div class="ms-auto">
                <a href="../includes/logout.php" class="btn btn-logout">Logout</a>
                </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
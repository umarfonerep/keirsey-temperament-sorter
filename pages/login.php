<?php
  session_start();
  include '../includes/db.php';
  include '../includes/auth.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
      $inemail = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $inemail = "Invalid email format.";
  } elseif (empty($password)) {
      $pas = "Password is required.";
  } else {
    if (loginUser($email, $password, $conn)) {
      if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
      } else {
        header("Location: dashboard.php");
      }
      exit();
    } else {
      $error = "Invalid email or password.";
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-3">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-white" style="border-radius: 1rem; background-color: #1E7AC2;">
            <div class="card-body p-5 text-center">
              <!-- Logo Section -->
              <div class="mb-4">
                <img src="../assets/logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
              </div>

              <div class="mb-md-5 mt-md-4 pb-5 ">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                <?php if (!empty($error)): ?>
            <div class="error-message text-center text-danger text-red-50"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
                  <form action="" method="POST">
                    <div data-mdb-input-init class="form-outline form-white mb-4 text-align">
                      <label class="form-label" for="typeEmailX">Email</label>
                      <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"  />
                      <?php if (!empty($inemail)): ?>
            <div class="error-message text-center text-danger text-red-50"><?php echo htmlspecialchars($inemail); ?></div>
        <?php endif; ?>
                    </div>

                    <div data-mdb-input-init class="form-outline form-white mb-4">
                      <label class="form-label" for="typePasswordX">Password</label>
                      <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
                      <?php if (!empty($pas)): ?>
            <div class="error-message text-center text-danger text-red-50"><?php echo htmlspecialchars($pas); ?></div>
        <?php endif; ?>
                    </div>

                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="forgot_password.php">Forgot password?</a></p>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                  </form>
              </div>

              <div>
                <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
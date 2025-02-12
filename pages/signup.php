<?php
session_start();
include '../includes/db.php';
include '../includes/auth.php';
if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($username, $first_name, $last_name, $phone, $email, $password, $conn)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 col-lg-8"> <!-- Wider form -->
                    <?php if (isset($error)): ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <div class="card text-white p-5" style="border-radius: 1rem; background-color: #1E7AC2;">
                        <div class="card-body">
                            <h2 class="fw-bold text-center">Sign Up</h2>
                            <p class="text-white-50 text-center">Please enter your details to create an account!</p>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="signupUsername">Username*</label>
                                        <input type="text" id="signupUsername" class="form-control form-control-lg" name="username" required />
                                        <span class="error"></span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="signupFirstName">First Name</label>
                                        <input type="text" id="signupFirstName" class="form-control form-control-lg" name="first_name" required />
                                        <span class="error"></span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="signupLastName">Last Name</label>
                                        <input type="text" id="signupLastName" class="form-control form-control-lg" name="last_name" required />
                                        <span class="error"></span>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="signupPhone">Phone</label>
                                        <input type="text" id="signupPhone" class="form-control form-control-lg" name="phone" required />
                                        <span class="error"></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="signupEmail">Email*</label>
                                        <input type="email" id="signupEmail" class="form-control form-control-lg input-lg" name="email" required />
                                        <span class="error"></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="signupPassword">Password*</label>
                                        <input type="password" id="signupPassword" class="form-control form-control-lg input-lg" name="password" required />
                                        <span class="error"></span>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="signupConfirmPassword">Confirm Password*</label>
                                        <input type="password" id="signupConfirmPassword" class="form-control form-control-lg input-lg" name="confirm_password" required />
                                        <span class="error">error</span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-outline-light btn-lg px-5 mt-3" type="submit">Sign Up</button>
                                    <p class="mt-3">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



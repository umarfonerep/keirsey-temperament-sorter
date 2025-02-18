<?php
session_start();
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT reset_token_expiry FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($reset_token_expiry);
        $stmt->fetch();

        if (strtotime($reset_token_expiry) > time()) {
            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
            $stmt->bind_param("ss", $new_password, $token);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Password reset successfully!";
            } else {
                echo "Failed to reset password. Please try again.";
            }
        } else {
            echo "Token has expired.";
        }
    } else {
        echo "Invalid token.";
    }

}

$token = $_GET["token"] ?? null;
if (!$token) {
    die("Invalid token.");
}

// $result = resetPassword($token, $new_password, $conn);

// if ($result === "Password reset successfully!") {
//     $success = $result;
// } else {
//     $error = $result;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Reset Password</h2>
                                <p class="text-white-50 mb-5">Enter your new password below.</p>

                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="new_password" name="new_password" class="form-control form-control-lg" required>
                                        <label class="form-label" for="new_password">New Password</label>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Change Password</button>
                                </form>

                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="login.php" class="text-white-50">Go Back to Login</a>
                                </div>
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
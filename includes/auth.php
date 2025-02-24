<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}


function registerUser($username, $first_name, $last_name, $phone, $organisation_name, $email, $password, $conn)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, first_name, last_name, phone, organization_name ) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssss", $username, $email, $hashedPassword, $first_name, $last_name, $phone,$organisation_name);
        return $stmt->execute();
    } else {
        return false;
    }
}

function loginUser($loginInput, $password, $conn)
{

    $query = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $loginInput, $loginInput);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        return true;
    }
    return false;
}

function sendPasswordResetLink($email, $mysqli)
{
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $result->free();
    if ($user) {
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $stmt = $mysqli->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();
        $resetLink = "http://keirsey-temperament-sorter.test/pages/reset_password.php?token=$token";
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'umar.fonerep@gmail.com';
            $mail->Password = 'jinw wayw izhh tdmu';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@keirsey-temperament-sorter.test', 'Keirsey Temperament Sorter');
            $mail->addAddress($email);

            $mail->isHTML(false);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the link below to reset your password:\n\n$resetLink\n\nThis link will expire in 1 hour.";

            $mail->send();
            error_log("Email sent successfully to $email");
            return true;
        } catch (Exception $e) {
            error_log("Failed to send email to $email: " . $mail->ErrorInfo);
            return false;
        }
    }
    return false;
}

// function resetPassword($token, $new_password, $conn) {

//     $stmt = $conn->prepare("SELECT reset_token_expiry FROM users WHERE reset_token = ?");
//     $stmt->bind_param("s", $token);
//     $stmt->execute();
//     $stmt->store_result();

//     if ($stmt->num_rows > 0) {
//         $stmt->bind_result($reset_token_expiry);
//         $stmt->fetch();

//         if (strtotime($reset_token_expiry) > time()) {
//             // Update the password and clear the reset token
//             $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
//             $stmt->bind_param("ss", $new_password, $token);
//             $stmt->execute();

//             if ($stmt->affected_rows > 0) {
//                 return "Password reset successfully!";
//             } else {
//                 return "Failed to reset password. Please try again.";
//             }
//         } else {
//             return "Token has expired.";
//         }
//     } else {
//         return "Invalid token.";
//     }
// }

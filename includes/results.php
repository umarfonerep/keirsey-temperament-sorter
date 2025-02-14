<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Results
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function storeResults($personalityType, $userid)
    {
        $query = "SELECT id FROM results WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $query = "UPDATE results SET personality_type = ? WHERE user_id = ?";
        } else {
            $query = "INSERT INTO results (user_id, personality_type) VALUES (?, ?)";
        }
        $stmt->close();

        $stmt = $this->conn->prepare($query);
        if (strpos($query, 'UPDATE') !== false) {
            $stmt->bind_param("si", $personalityType, $userid);
        } else {
            $stmt->bind_param("is", $userid, $personalityType);
        }

        return $stmt->execute();
    }

    public function getAlldata()
    {
        $data = [];

        // Fetch all results
        $stmt = $this->conn->prepare("SELECT * FROM results");
        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
        $stmt->close();

        // Fetch data based on personality type
        $query = "SELECT d.* FROM data d JOIN results r ON d.personality_type = r.personality_type";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
        $data['personality_data'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Fetch usernames of users who have results
        $query = "SELECT u.username FROM users u JOIN results r ON u.id = r.user_id";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
        $data['users'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $data;
    }

    public function getDataByUserId($user_id)
    {
        $query = "
            SELECT d.*
            FROM data d
            JOIN results r ON d.personality_type = r.personality_type
            WHERE r.user_id = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $data ?: [];
    }

    public function process($responses_encode, $userid)
    {
        $traits = ['E' => 'I', 'S' => 'N', 'T' => 'F', 'J' => 'P'];
        $scores = array_fill_keys(array_merge(array_keys($traits), array_values($traits)), 0);

        foreach ($responses_encode as $question => $value) {
            $questionNum = (int) filter_var($question, FILTER_SANITIZE_NUMBER_INT);
            $traitKeys = array_keys($traits);
            $trait1 = $traitKeys[($questionNum - 1) % 4]; // Cycle through traits for 70 questions
            $trait2 = $traits[$trait1];

            $value = (float) $value;
            $scores[$trait1] += $value;
            $scores[$trait2] += (1 - $value);
        }
        $personalityType = '';
        $personalityType .= $scores['E'] > $scores['I'] ? 'E' : 'I';
        $personalityType .= $scores['S'] > $scores['N'] ? 'S' : 'N';
        $personalityType .= $scores['T'] > $scores['F'] ? 'T' : 'F';
        $personalityType .= $scores['J'] > $scores['P'] ? 'J' : 'P';

        $this->storeResults($personalityType, $userid);
        // return $this->getDataByUserId($userid);
    }

    public function shareResultLink($user_id, $email)
    {
        if (empty($user_id)) {
            throw new Exception("User ID cannot be null or empty.");
        }

        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $resetLink = "http://keirsey-temperament-sorter.test/pages/report.php?token=$token";

        // Store the token in the database
        $query = "INSERT INTO result_tokens (user_id, token, expiry) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss", $user_id, $token, $expiry);
        $stmt->execute();
        $stmt->close();

        // Send the email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'umar.fonerep@gmail.com';
            $mail->Password = 'jinwwaywizhhtdmu';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@keirsey-temperament-sorter.test', 'Keirsey Temperament Sorter');
            $mail->addAddress($email);

            $mail->isHTML(false);
            $mail->Subject = 'Result Share';
            $mail->Body = "Click the link below to check your result:\n\n$resetLink\n\nThis link will expire in 1 hour.";

            $mail->send();
            error_log("Email sent successfully to $email");
            return true;
        } catch (Exception $e) {
            error_log("Failed to send email to $email: " . $mail->ErrorInfo);
            return false;
        }
    }
}

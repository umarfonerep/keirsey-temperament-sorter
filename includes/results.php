<?php

class Results{

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function storeResults($personalityType, $userid) {
    
        $query = "SELECT * FROM results WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $query = "UPDATE results SET personality_type = ? WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $personalityType, $userid);
        } else {
            $query = "INSERT INTO results (user_id, personality_type) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("is", $userid, $personalityType);
        }
    
        return $stmt->execute();
    }


    public function getDataByUserId($user_id) {

        $query = "
            SELECT d.*
            FROM data d
            JOIN results r ON d.personality_type = r.personality_type
            WHERE r.user_id = ?
        ";
        
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            
            return $data;
        } else {
            
            return [];
        }
    }

}


?>
<?php 

class Responces {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getReponces($userid) {
        $query = "SELECT userid, question_responce FROM RESPONCES WHERE userid = ?";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            $reponces = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            
            return $reponces;
        } else {

            return [];
        }
    }

    public function storeResponces($data, $userid) {
        $json_responses = json_encode($data);
    
        $query = "SELECT * FROM RESPONCES WHERE userid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $query = "UPDATE RESPONCES SET question_responce = ? WHERE userid = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $json_responses, $userid);
        } else {
            $query = "INSERT INTO RESPONCES (userid, question_responce) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("is", $userid, $json_responses);
        }
    
        return $stmt->execute();
    }
    
    

}

?>
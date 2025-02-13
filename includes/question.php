<?php
class Question {
    private $conn;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllQuestions() {
        $query = "SELECT qid, qtext FROM Questions";
        $result = $this->conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); 
        } else {
            return []; 
        }
    }

    public function editQuestion($id) {
        $query = "SELECT qtext FROM Questions WHERE qid = $id";
        $result = $this->conn->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); 
        }
        return false;
    }

    public function updateQuestion($heading, $id) {
        $query = "UPDATE Questions SET qtext = ? WHERE qid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $heading, $id);
        
        if ($stmt->execute()) {
            return true; 
        } else {
            return false;
        }
    }
}
?>
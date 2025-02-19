<?php
class Data {

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getData()
    {
        $query = "SELECT personality_type,result_group,displayed_behaviours,careers FROM data ";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $reponces = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            
            return $reponces;
        } else {

            return [];
        }
    }

}

?>
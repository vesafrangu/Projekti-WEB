public function getAllUsers() {
        $sql = "SELECT id, username, role FROM $this->registration";  // Exclude email if it's not in the table
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

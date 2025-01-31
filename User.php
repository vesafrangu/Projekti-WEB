<?php
require_once('DbConnect.php'); // Include the DB connection

class User {
    private $dbConn;
    private $registration = 'registration'; // Table name
    private $registration2 = 'contact';

    public function __construct() {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }
    public function create2($username, $password, $role = "user") {
        $sql = "INSERT INTO $this->registration (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->dbConn->prepare($sql);
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function create($username, $password, $role = "admin") {
        $sql = "INSERT INTO $this->registration (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->dbConn->prepare($sql);
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMessage($name, $email, $message ) {
        $sql = "INSERT INTO $this->registration2 (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $this->dbConn->prepare($sql);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    

    // Function to log in the user
    public function login($username, $password) {
        $sql = "SELECT * FROM $this->registration WHERE username = :username";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Directly compare plain text password with the stored password
        if ($user && $password === $user['password']) {
            session_start(); // Ensure session is started for storing session variables
            $_SESSION['username'] = $user['username']; // Store username in session
            $_SESSION['role'] = $user['role'];

            return $user['role'];
            return true;
        } else {
            return false;
        }
    }

    public function update($currentUsername, $newUsername, $newPassword) {
      

        $sql = "UPDATE $this->registration SET username = :newUsername, password = :newPassword WHERE username = :currentUsername";
        $stmt = $this->dbConn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':newUsername', $newUsername);
        $stmt->bindParam(':newPassword', $newPassword);
        $stmt->bindParam(':currentUsername', $currentUsername);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($username) {
        // Use the correct property for the table name
        $sql = "DELETE FROM $this->registration WHERE username = :username";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':username', $username);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

      // Function to log out the user
      public function logout() {
        session_start(); // Start the session
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        return true;
    }
}
  
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



    
</body>
</html>

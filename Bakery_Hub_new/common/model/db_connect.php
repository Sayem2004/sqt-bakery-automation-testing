<?php
class DatabaseConnection {
   
    function openConnection() {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "bakaryDB"; 

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($connection->connect_error) {
            die("Failed to connect database " . $connection->connect_error);
        }

        return $connection;
    }

    
    function registerUser($conn, $table, $name, $phone, $email, $password, $role) {
        $name = mysqli_real_escape_string($conn, $name);
        $phone = mysqli_real_escape_string($conn, $phone);
        $email = mysqli_real_escape_string($conn, $email);
        $role = mysqli_real_escape_string($conn, $role);
        
        $checkEmail = "SELECT * FROM $table WHERE email = '$email'";
        $result = $conn->query($checkEmail);
        
        if ($result->num_rows > 0) {
            return "EmailExists"; 
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $table (name, phone, email, password, role) VALUES ('$name', '$phone', '$email', '$hashedPassword', '$role')";
        
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return "Error: " . $conn->error;
        }
    }

    function loginUser($conn, $table, $email, $password) {
        $email = mysqli_real_escape_string($conn, $email);

        $sql = "SELECT * FROM $table WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false; 
    }
} 
?>
<?php
class User
{
    function register($email,$firstname,$lastname,$password) {
        $conn = new DB();
        $sql = "INSERT INTO user (email,firstname,lastname,password) VALUES (?,?,?,?)";
        
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$email, $firstname, $lastname, password]);
        
    }
}


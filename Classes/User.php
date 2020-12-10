<?php
class User
{
    public function register($email,$firstname,$lastname,$password) {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("INSERT INTO user (email, first_name, last_name, `password`) VALUES (?,?,?,?)");
            
            $stmt->execute([$email, $firstname, $lastname, $password]);
            $result = $stmt->fetch();
            $connection = null;
            return $result;
        
        }
        catch(PDOexception $e){
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
    
            print "Error!: " . $e->getMessage() . "<br/>";
        }

    exit;
    }



    public function login($username,$password){
        try{
            $conn = (new DB)->connect();

            $sql = $conn->prepare("SELECT user_id, first_name, password FROM users WHERE first_name = '$username' AND password = '$password'");

            $sql->execute([$username,$password]);
            $result = $sql->fetch();
            $connection = null;
            return $result;
        }
        catch(PDOexception $e){
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
    
            print "Error!: " . $e->getMessage() . "<br/>";
        }

    exit;
    }
} 




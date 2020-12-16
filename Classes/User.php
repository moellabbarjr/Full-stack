<?php
if(!isset($_SESSION)) session_start();
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

    public function login($email,$password){
        try {
            $connection = DB::connect();

            $stmt= $connection->prepare("SELECT * FROM `user` WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();
            
            if (count($result) == 1) {
                if (password_verify($password, $result[0][4])) {
                    $_SESSION["sessionid"] = session_id();
                    $_SESSION["loggedin"] = $result[0][0];
                    $_SESSION["role"] = $result[0][5];
                    header("Location: ../index.php");
                }
            }
        } catch (PDOException $e) {
            return false;
        } 

    exit;
    }
} 




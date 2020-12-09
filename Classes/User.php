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
        catch(PDOxception $e){
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
    
            print "Error!: " . $e->getMessage() . "<br/>";
        }

    exit;
    }
}


<?php

class User
{
    //Function to register a user
    public function register($email,$firstname,$lastname,$password) {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("INSERT INTO user (email, first_name, last_name, `password`) VALUES (?,?,?,?)");
            
            $stmt->execute([$email, $firstname, $lastname, $password]);
            $result = $stmt->fetch();
            $connection = null;
            return $result;
        
        }
        catch(PDOexception $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
    
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    exit;
    }

    //Function to login a user
    public function login($email,$password){
        try {
            $connection = DB::connect();

            $stmt= $connection->prepare("SELECT * FROM `user` WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();
            
            if (count($result) == 1) {
                if (password_verify($password, $result[0][4])) {
                    session_start();
                    $_SESSION["sessionid"] = session_id();
                    $_SESSION["loggedin"] = $result[0][0];
                    $_SESSION["role"] = $result[0][5];
                    $_SESSION['name'] = $result[0][2];
                    header("Location: dashboard.php");
                }
            }
        } catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
    
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    exit;
    }


    //Function to get all users
    public function getAllUsers() {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->query("SELECT * FROM user");

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $connection = null;
            return $result;

        }
        catch (PDOException $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
    
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }
    
    public function getUserById($id) {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("SELECT * FROM user WHERE user_id  = ?");
            $stmt->execute([$id]);
            
            $result = $stmt->fetch();
            $connection = null;

            return $result;

        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),

            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    public function searchUser($search) {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->query("SELECT * FROM user WHERE email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%'");

            $result = $stmt->fetchAll();
            $connection = null;

            return $result;
        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),

            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }
    public function getJobs() {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("SELECT * FROM job");
            $stmt->execute();

            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $connection = null;

            return $result;
        }
        catch(PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),

            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    public function getRoles(){
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("SELECT * FROM `role`");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $connection = null;
            
            return $result;
        }
        catch(PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),

            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }

    public function updateUser($id, $firstName, $lastName, $email) {
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("UPDATE user SET first_name=?, last_name=?,email=?  WHERE user_id = ? ");
            $stmt->execute([$firstName, $lastName, $email, $id]);

            $connection = null;

            return true;

        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),

            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }
    public function deleteUser($id){
        try{
            $conn = (new DB)->connect();

            $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ? ");
            $stmt->execute([$id]);

            $connection = null;

            return true;

        }
        catch (PDOException $e) {
            echo json_encode([ 
                'error' => $e->getMessage(),

            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }
        exit;
    }
    
} 




<?php
/**
 * Created by PhpStorm.
 * User: Shaqu
 * Date: 10-12-2020
 * Time: 14:56
 */

class Availability
{
    public function add($monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$job_preference) {
        try{
            $conn = (new DB)->connect();
            $stmt = $conn->prepare("SELECT * FROM availability WHERE user_id = ?");
            $stmt->execute([$_SESSION['loggedin']]);
            $result = $stmt->fetch();

            if ($result[0]) {
                $stmt = $conn->prepare("UPDATE availability SET monday = ?, tuesday = ?, wednesday = ?, thursday = ?, friday = ?, saturday = ?, sunday = ?,job_preference = ?, user_id = ? WHERE user_id = ?");
                $stmt->execute([$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$job_preference,$_SESSION["loggedin"],$_SESSION["loggedin"]]);
                header("Location: dashboard.php");
            }
            else {
                $stmt = $conn->prepare("INSERT INTO availability (monday, tuesday, wednesday, thursday, friday, saturday, sunday, job_preference, user_id) VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt->execute([$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$job_preference,$_SESSION["loggedin"]]);
                header("Location: dashboard.php");
            }

            $connection = null;

        }
        catch(PDOxception $e){
            return json_encode([
                'error' => $e->getMessage(),
            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }

        exit;
    }
    public function Fetch() {
        try{
            if ($_SESSION["role"] == 1) {
                $conn = (new DB)->connect();
                $stmt = $conn->prepare( "SELECT * FROM availability a INNER JOIN user u ON a.user_id=u.user_id WHERE a.user_id = ?;");
                $stmt->execute([$_SESSION["loggedin"]]);
                $result = $stmt->fetchAll();
                return $result;
            }
            else if ($_SESSION["role"] == 2) {
                $conn = (new DB)->connect();
                $stmt = $conn->prepare( "SELECT * FROM availability a INNER JOIN user u ON a.user_id=u.user_id WHERE a.job_preference = ?;");
                $stmt->execute([$_SESSION["job_role"]]);
                $result = $stmt->fetchAll();
                return $result;
            }
            else if ($_SESSION["role"] == 3) {

            }
            
        }
        catch(PDOexception $e){
            return json_encode([
                'error' => $e->getMessage(),
            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }

        exit;


    }
}
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

            $stmt = $conn->prepare("INSERT INTO availability (monday, tuesday, wednesday, thursday, friday, saturday, sunday, job_preference, user_id) VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->execute([$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$job_preference,$_SESSION["loggedin"]]);
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
}
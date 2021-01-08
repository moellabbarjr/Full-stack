<?php
/**
 * Created by PhpStorm.
 * User: Shaqu
 * Date: 10-12-2020
 * Time: 14:56
 */

class Availability
{
    public function add($monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday) {
        try{
            $conn = (new DB)->connect();
            $userid = 2;
            $stmt = $conn->prepare("INSERT INTO availability (monday, tuesday, wednesday, thursday, friday, saturday, sunday, user_id) VALUES (?,?,?,?,?,?,?,?)");

            $stmt->execute([$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$userid]);
            $connection = null;


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
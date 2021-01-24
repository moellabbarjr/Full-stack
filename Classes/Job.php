<?php
/**
 * Created by PhpStorm.
 * User: Shaqu
 * Date: 10-12-2020
 * Time: 13:45
 */

class Job
{
    public function getJob()
    {
        try {
            $conn = (new DB)->connect();

            $stmt = $conn->query("SELECT `job_id` , `job_title` FROM job");

            $result = $stmt->fetchAll();
            $connection = null;
            return $result;

        } catch (PDOxception $e) {
            echo json_encode([
                'error' => $e->getMessage(),
            ]);

            print "Error!: " . $e->getMessage() . "<br/>";
        }

        exit;
    }
}
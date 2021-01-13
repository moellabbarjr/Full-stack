<?php

class add_job {
    public function add_newjob($startTime, $endTime, $date, $job, $volunteer){
        try {
            $conn = DB::connect();

            
            $stmt = $conn->prepare("INSERT INTO `agenda` (`job_id`, `user_id`, `startTime`, `endTime`, `date`) VALUES (?,?,?,?,?)");
            $stmt->execute([$job, $volunteer, $startTime, $endTime, $date]);
            
            
        } catch (PDOException $e) {
            return false;
        } 

    exit;
    }

    public function different_jobs(){
        try {
            $conn = DB::connect();

            
            $stmt = $conn->prepare("SELECT * FROM `job`");
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            return false;
        } 

    exit;
    }

    public function volunteer(){
        try {
            $conn = DB::connect();

            
            $stmt = $conn->prepare("SELECT * FROM `user` WHERE `role` = 1 ");
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            return false;
        } 

    exit;
    }
}
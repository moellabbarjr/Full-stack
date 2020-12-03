<?php

if(!isset($_SESSION)) session_start();

class DB {
    public function connect() {
        $connect = "mysql:host=localhost;dbname=vvza_database";
        $user = "root";
        $pass = "";

        return new PDO($connect, $user, $pass);
    }
}
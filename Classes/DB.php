<?php
class DB
{
    public function connect() {

    $dns = 'mysql:host=127.0.0.1;dbname=vvza_database';
    $user = 'root';
    $pass = '';

    return new PDO($dns, $user, $pass);
    }
}

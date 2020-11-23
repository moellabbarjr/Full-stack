<?php

class users
{
    public function register_user()
    {
        try {
            $connection = (new DB)->connect();

        } catch (PDOException $e) {
            return false;
        }
    }

    public function login_user()
    {
        try {
            $connection = (new DB)->connect();
            
        } catch (PDOException $e) {
            return false;
        }
    }
}

<?php
session_start();
    unset($_SESSION["sessionid"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["role"]);
    header("location: ../index.php");
    die();

<?php
session_start();
    unset($_SESSION["sessionid"]);
    unset($_SESSION["loggedin"]);
    header("location: index.php");
    die();
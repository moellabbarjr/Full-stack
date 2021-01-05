<?php include("../Layout/header.php");

$user = (new User)->deleteUser($_GET['user_id']);
header("location:users.php");
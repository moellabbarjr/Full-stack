<?php include("../Layout/header.php");

switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Er is iets fout gegaan met het inloggen, probeer het opnieuw. U word over 5 seconden terug gestuurd.");
        header("refresh:6;url=login.php");
        break;
    case "1":
    case "2":
        $deny = true;
        echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
        header("refresh:5;url=dashboard.php");
        break;
    case "3":
        $user = (new User)->deleteUser($_GET['user_id']);
        header("location:users.php");

}
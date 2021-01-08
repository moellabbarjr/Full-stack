<?php include("../Layout/header.php");

if($_SESSION['role'] == 1 ){
    echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
    header("refresh:5;url=dashboard.php");
}
if($_SESSION['role'] == 2 ){
    echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
    header("refresh:5;url=dashboard.php");
}
if($_SESSION['role'] == 3) {
    $user = (new User)->deleteUser($_GET['user_id']);
    header("location:users.php");
}






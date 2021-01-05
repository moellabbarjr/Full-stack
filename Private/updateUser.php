<?php include("../Layout/Header.php"); 
$_GET['firstname'] = $firstname;
$_GET['lastname'] = $lastname;
$_GET['user_id'] = $id;
$_GET['email'] = $email;
if($updateUser = (new User)->updateUser($id, $firstname, $lastname, $email)){
    $failed = false;
    header("location:users.php");
}else{
    $failed = true;
}


if($failed == true) {
    echo "Er is iets fout gegaan, probeer het later nog eens.";
}




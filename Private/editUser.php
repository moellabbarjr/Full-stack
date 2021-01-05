<?php include("../Layout/Header.php"); 

$user = (new User)->getUserById($_GET["user_id"]);
if(isset($_POST['submit'])){
    $email = htmlspecialchars($_POST['email']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);

    if((new User)->updateUser($user['user_id'],$firstname,$lastname,$email)){
        header("location:users.php");
    }else{
        echo "Er ging iets fout met het aanpassen van de gebruiker, probeer het later nog eens.";
    }
}

?>

<table class="table table-striped table-responsive-md btn-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Email adres</th>
        <th>Voornaam</th>
        <th>Achternaam</th>
        <th>Update</th>
    </tr>
    </thead>
    <tbody>
    <form method="POST">
        <tr>
        <th scope="row"><?= $user['user_id']?></th>
        <td><input value="<?= $user['email']?>" name="email" type="text" ></td>
        <td><input value="<?= $user['first_name']?>"name="firstname" type="text" ></td>
        <td><input value="<?= $user['last_name']?>"name="lastname" type="text" ></td>
       
        <?php
                echo '<td>';  
                echo '<button name="submit" class="btn btn-success">Opslaan</button>';
                echo '</td>';
        ?>
        </form>
        </tr>
    </tbody>
</table>
<?php include("../Layout/Header.php"); 

$deny = false;
switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Er is iets fout gegaan met het inloggen, probeer het opnieuw. U word over 5 seconden terug gestuurd.");
        header("refresh:6;url=login.php");
        break;
    case 1:
    case 2:
        $deny = true;
        echo("Uw heeft niet de rechten om dit te zien, over 5 seconden word u teruggestuurd naar uw dashboard.");
        header("refresh:5;url=dashboard.php");
        break;
}

$user = (new User)->getUserById($_GET["user_id"]);
$jobs = (new User)->getJobs();
$roles = (new User)->getRoles();
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

if($deny == false){

?>
<div class="container">
    <div class="roles">
        <p class="role">Rollen:
            1: Gebruiker,
            2: Coördinator,
            3: Beheerder
            <a href="users.php"><button class="btn btn-warning goBack">Ga Terug</button><a>
        </p>
    </div>
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Email adres</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Coördinator?</th>
            <th>Rol</th>
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
            <td>
                <select>
                <?php
                    foreach($jobs as $job){
                        
                ?>
                    <option><?=$job['job_title']?></option>
                <?php
                    }
                ?>
                </select>
            </td>
            <td>
            <select>
                <?php
                    foreach($roles as $role){
                        
                ?>
                    <option id="<?=$role['role_id']?>"><?=$role['role_id']?></option>
                <?php
                    }
                ?>
                </select>
            </td>

            
            <?php
                    echo '<td>';  
                    echo '<button name="submit" class="btn btn-success">Opslaan</button>';
                    echo '</td>';
            ?>
            </form>
            </tr>
        </tbody>
    </table>
</div>
<?php
} 
?>
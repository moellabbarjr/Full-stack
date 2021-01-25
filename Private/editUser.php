<?php include("../Layout/Header.php"); 

$deny = false;
switch($_SESSION['role']){
    case NULL:
        $deny = true;
        echo("Er is iets fout gegaan met het inloggen, probeer het opnieuw. U word over 5 seconden terug gestuurd.");
        header("refresh:6;url=login.php");
        break;
    case "user":
    case "admin":
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
    $job = htmlspecialchars($_POST['job']);
    $role = htmlspecialchars($_POST['role']);

    if((new User)->updateUser($user['user_id'],$firstname,$lastname,$email,$job,$role)){
        var_dump($_POST);
    }else{
        echo "Er ging iets fout met het aanpassen van de gebruiker, probeer het later nog eens.";
   }
}
if($deny == false){

?>
<div class="container">
    <div class="roles">
        <a href="users.php"><button class="btn btn-warning goBack">Ga Terug</button><a>
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
                <select name="job">
                    <option id="currentjob" value=<?=$user['job_role']?>><?=$user['job_title']?></option>

                    <?php
                        foreach($jobs as $job){
                            
                    ?>
                        <option value="<?=$job['job_id']?>"><?=$job['job_title']?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
            <td>
                <select name="role">
                    <option id="currentrole" ><?=$user['role']?></option>
                        <?php
                
                            foreach($roles as $role){
                                if($user['role'] == $role['role']){
                                }else{
                        ?>  
                            <option id="<?=$role['role_id']?>" name="role"><?=$role['role']?></option>
                        <?php
                            }
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
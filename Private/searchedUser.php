<?php include("../Layout/Header.php"); 
$search = $_GET['search'];

$searchedUsers = (new User)->searchUser($search);

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

if($deny == false){


?>
<div class="container">
    <a href="users.php"><button class="btn btn-warning goBack">Ga Terug</button><a>
    <table class="table table-striped table-responsive-md btn-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Email adres</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($searchedUsers as $searchedUser) {
                echo '<tr>';
                echo '<th scope="row">' . $searchedUser["user_id"] . '</th>';
                echo '<td>' . $searchedUser["email"] . '</td>';
                echo '<td>' . $searchedUser["first_name"] . '</td>';
                echo '<td>' . $searchedUser["last_name"] . '</td>';
                echo '<td>
                        <button type="button" class="btn btn-success"><a href="editUser.php?user_id=' . $searchedUser["user_id"] . '"[>Bewerken</a></button>
                    </td>';
                echo '<td>
                        <button type="button" class="btn btn-danger"><a href="deleteUser.php?user_id=' . $searchedUser["user_id"] . '">Verwijderen</a></button>
                    </td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<?php
} 
?>
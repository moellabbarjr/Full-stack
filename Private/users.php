<?php include("../Layout/Header.php"); 
  if (!isset($_SESSION)) {
    session_start();
  }
$records = (new User)->getAllUsers();
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
    <div class="searchdiv">
        <form method="GET" action="searchedUser.php">
            <input type="text" placeholder=" Zoeken..." class="searchbar" name="search"><button class="btn btn-primary search-btn" name="submit"><i class='fas fa-search'></i></button>
        </form>
    </div>
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
            foreach ($records as $record) {
                echo '<tr>';
                echo '<th scope="row">' . $record["user_id"] . '</th>';
                echo '<td>' . $record["email"] . '</td>';
                echo '<td>' . $record["first_name"] . '</td>';
                echo '<td>' . $record["last_name"] . '</td>';
                echo '<td>
                        <button type="button" class="btn btn-success"><a href="editUser.php?user_id=' . $record["user_id"] . '"[>Bewerken</a></button>
                    </td>';
                echo '<td>
                        <button type="button" class="btn btn-danger"><a href="deleteUser.php?user_id=' . $record["user_id"] . '">Verwijderen</a></button>
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


<?php include("../Layout/Footer.php"); 

?>


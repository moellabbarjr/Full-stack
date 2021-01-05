<?php include("../Layout/Header.php"); 
$records = (new User)->getAllUsers()
?>
<div class="container">

    <div class="searchdiv">
        <input type="text" placeholder=" Zoeken..." class="searchbar"> <button class="btn btn-primary search-btn"><i class='fas fa-search'></i></button>
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
        <?php foreach ($records as $record) {
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


<?php include("../Layout/Footer.php"); 

?>


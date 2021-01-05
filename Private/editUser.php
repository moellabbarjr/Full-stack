<?php include("../Layout/Header.php"); 

$user = (new User)->getUserById($_GET["user_id"]);
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
        <tr>
        <th scope="row"><?= $user['user_id']?></th>
        <td><input value="<?= $user['email']?>"></td>
        <td><input value="<?= $user['first_name']?>"></td>
        <td><input value="<?= $user['last_name']?>"></td>
        <?php
                echo '<td>';  
                echo '<a class="btn btn-success" href="updateUser.php?user_id=' . $user['user_id'] . '?firstname=' . $user['first_name'] . '?lastname=' . $user['last_name'] . '?email=' . $user['email'] . '">Opslaan</a>';
                echo '</td>';
        ?>
        </tr>
    </tbody>
</table>
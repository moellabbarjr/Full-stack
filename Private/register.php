<?php include("../Layout/Header.php"); 

$user = (new User);

if(isset($_POST['register'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordRepeat = htmlspecialchars($_POST['passwordRepeat']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    if($password == $passwordRepeat){
        $hashPass = password_hash($password, PASSWORD_DEFAULT);
        $user->register($email,$firstname,$lastname,$hashPass);
        return true;
    }else{
        return false;
    }
}

?>

<p class="Hoofdtext">Registeer</p>

<div class="container container-center">
<div class="loginCard">
        <div class="title">
          <p>VVZA Vrijwilligers Portaal</p>
        </div>
        <form action="" method="POST">
          <div class="input-group">
            <label for="loginEmail">E-mailadres:</label>
            <input id="loginEmail" type="email" placeholder="E-mailadres" name="email" >
          </div>
          <div class="input-group">
            <label for="loginPassword" class="align">Voornaam:</label>
            <input id="loginPassword" type="text" placeholder="Voornaam" name="firstname" class="aligner" >
          </div>
          <div class="input-group">
            <label for="loginPassword">Achternaam:</label>
            <input id="loginPassword" type="text" placeholder="Achternaam" name="lastname">
          </div>
          <div class="input-group">
            <label for="loginPassword">Wachtwoord:</label>
            <input id="loginPassword" type="password" placeholder="Wachtwoord" name="password" >
          </div>
          <div class="input-group">
            <label for="loginPassword">Herhaal Wachtwoord:</label>
            <input id="loginPassword" type="password" placeholder="Herhaal Wachtwoord" name="passwordRepeat" >
          </div>
          <div class="button-container">
            <button type="submit" name="register" class="btn">Aanmelden</button> <br>
            <a href="login.php"><button type="button" name="Anu" class="btn">Annuleren</button></a>
          </div>
        </form>
      </div>
</div>

<?php include("../Layout/Footer.php");?>
<?php include("../Layout/Header.php"); 

$user = (new User);

if(isset($_POST['register'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordRepeat = htmlspecialchars($_POST['passwordRepeat']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    if($password == $passwordRepeat){
        $user->register($email,$firstname,$lastname,$password);
        return true;
    }else{
        return false;
    }
}

?>
<div class="container container-center">
<div class="loginCard">
        <div class="title">
          <p>VVZA Vrijwilligers Portaal</p>
        </div>
        <form action="" method="POST">
          <div class="input-group">
            <label for="loginEmail">E-mailadres:</label>
            <input id="loginEmail" type="email" placeholder="E-mailadres" name="email" required>
          </div>
          <div class="input-group">
            <label for="loginPassword" class="align">Voornaam:</label>
            <input id="loginPassword" type="text" placeholder="Voornaam" name="firstname" class="aligner" required>
          </div>
          <div class="input-group">
            <label for="loginPassword">Achternaam:</label>
            <input id="loginPassword" type="text" placeholder="Achternaam" name="lastname"required>
          </div>
          <div class="input-group">
            <label for="loginPassword">Wachtwoord:</label>
            <input id="loginPassword" type="password" placeholder="Wachtwoord" name="password" required>
          </div>
          <div class="input-group">
            <label for="loginPassword">Wachtwoord:</label>
            <input id="loginPassword" type="password" placeholder="Herhaal Wachtwoord" name="passwordRepeat" required>
          </div>
          <div class="button-container">
            <!-- <button id="loginBtn" type="button" name="login" class="btn">Inloggen</button> -->
            <button type="submit" name="register" class="btn">Aanmelden</button>
          </div>
        </form>
      </div>
</div>

<?php include("../Layout/Footer.php");?>
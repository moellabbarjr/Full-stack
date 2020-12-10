<?php include("../Layout/Header.php"); 

$login = (new User);

  if(isset($_POST['submit'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
      
    $login->login($email,$hashPass);

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
            <input id="loginEmail" type="text" name="email" placeholder="E-mailadres" required>
          </div>
          <div class="input-group">
            <label for="loginPassword">Wachtwoord:</label>
            <input id="loginPassword" type="password" name="password" placeholder="Wachtwoord" required>
          </div>
          <div class="button-container">
            <button id="loginBtn" name="submit" class="submit" type="submit">Inloggen</button>
            <a href="register.php"><button type="button" name="login" class="btn">Registreren</button></a>
          </div>
        </form>
      </div>
</div>

<?php include("../Layout/Footer.php");?>
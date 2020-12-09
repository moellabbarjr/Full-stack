<?php include("../Layout/Header.php"); 

?>
<div class="container container-center">
<div class="loginCard">
        <div class="title">
          <p>VVZA Vrijwilligers Portaal</p>
        </div>
        <form>
          <div class="input-group">
            <label for="loginEmail">E-mailadres:</label>
            <input id="loginEmail" type="text" placeholder="E-mailadres" required>
          </div>
          <div class="input-group">
            <label for="loginPassword">Wachtwoord:</label>
            <input id="loginPassword" type="password" placeholder="Wachtwoord" required>
          </div>
          <div class="button-container">
            <button id="loginBtn" type="button" name="login" class="btn">Inloggen</button>
            <a href="register.php"><button type="button" name="login" class="btn">Registreren</button></a>
          </div>
        </form>
      </div>
</div>

<?php include("../Layout/Footer.php");?>
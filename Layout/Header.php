<?php
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set("Europe/Amsterdam");
setlocale(LC_TIME, 'Dutch');

spl_autoload_register(function ($class) {
    require $_SERVER['DOCUMENT_ROOT'] . '/Classes/' . $class . '.php';
});
?>
<!DOCTYPE html>
<html lang="nl">
<head>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/f1e6762606.js" crossorigin="anonymous"></script>
  <script src="Javascript/script.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../Style/Main.css">
  <title>VVZA Portaal</title>

</head>
<body>
  <nav>
    <div class="links">

    
    <a href="../index.php" class="vvzaIcon">
      <image class="vvzaIcon" src="../Style/igootje.png"></image>
    </a>

      <p class="navTitle">VVZA Portaal</p>
    
    </div>
   
    <div class="rechts">
      
    <ul>
      <li>
        
        <?php if (!isset($_SESSION["sessionid"])) { ?>
          <a href="../index.php">Home</a>
          <a href="../Private/login.php">Login</a>
        <?php } ?>
        <?php if (isset($_SESSION["sessionid"])) {
            if($_SERVER['REQUEST_URI'] == "/index.php"){ ?>
            <a href="Private/dashboard.php">Home</a>
            <a href="Private/registration_form.php">Beschikbaarheid</a>
            <a href="Private/logout.php">Log uit</a>
        <?php
            }else{
        ?>
            <a href="dashboard.php">Home</a>
            <a href="registration_form.php">Beschikbaarheid</a>
            <a href="logout.php">Log uit</a>
          <?php }
          }
          ?>
      </li>
    </ul>
    </div>
  </nav>

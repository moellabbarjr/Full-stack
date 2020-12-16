<?php
if(!isset($_SESSION)) session_start();

spl_autoload_register(function($class){
  require '../Classes/' . $class . '.php';

}); 
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Main.css">
    <script src="Javascript/script.js"></script>
    <script src="https://kit.fontawesome.com/f1e6762606.js" crossorigin="anonymous"></script>
    <title>VVZA Portaal</title>
</head>
<body>
  <nav>
    <div class="links">
    <a href="../index.php" class="vvzaIcon">
      <image src="../Style/igootje.png"></image>
    </a>
    <p>VVZA Portaal</p>
    </div>
    <div class="rechts">
    <ul>
      <li>
        <a class="active" href="../index.php">Home</a>
        <?php if(!isset($_SESSION["sessionid"])) { ?>
          <a class="active" href="../Private/login.php">Login</a>
        <?php } ?>
        <?php if(isset($_SESSION["sessionid"])) { ?>
          <a class="active" href="../logout.php">logout</a>
        <?php } ?>
      </li>
    </ul>
    </div>
  </nav>
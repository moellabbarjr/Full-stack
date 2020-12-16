<?php
if(!isset($_SESSION)) session_start();
date_default_timezone_set("Europe/Amsterdam");
setlocale(LC_TIME, 'Dutch');

spl_autoload_register(function($class){
  require $_SERVER['DOCUMENT_ROOT'] . '/Classes/' . $class . '.php';
});
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Main.css">
    <link rel="icon" href="../Style/igootje.png">
    <script src="https://kit.fontawesome.com/f1e6762606.js" crossorigin="anonymous"></script>
    <title>VVZA Vrijwilligers Portaal</title>
</head>
<body>
  <nav>
    <div class="links">
    <a href="../index.php" class="">
      <image class="vvzaIcon" src="../Style/igootje.png"></image>
    </a>
    <p>Vrijwilligers portaal</p>
    
    </div>
   
    <div class="rechts">
      
    <ul>
      <li>
        <a href="../index.php">Home</a> | 
        <?php if(!isset($_SESSION["sessionid"])) { ?>
          <a href="../Private/login.php">Login</a>
        <?php } ?>
        <?php if(isset($_SESSION["sessionid"])) { ?>
          <li><a href="../logout.php">logout</a></li>
        <?php } ?>
      </li>
    </ul>
    </div>
  </nav>
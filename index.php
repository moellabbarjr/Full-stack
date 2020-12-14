<?php
session_start();
date_default_timezone_set("Europe/Amsterdam");
setlocale(LC_TIME, 'Dutch');

function my_autoloader($class) {
    include 'Classes/' . $class . '.php';
}
include 'Classes/Calendar.php'; // autoloader ish broken :(

$calendar = new Calendar();

if (!isset($_SESSION["week_offset"])) {
  $_SESSION["week_offset"] = 0;
}

if (isset($_POST["previous"])) {
  $_SESSION["week_offset"]--;
}

if (isset($_POST["next"])) {
  $_SESSION["week_offset"]++;
}

if (isset($_POST["reset"])) {
  $_SESSION["week_offset"] = 0;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Main.css">
    <script src="https://kit.fontawesome.com/f1e6762606.js" crossorigin="anonymous"></script>
    <title>VVZA Portaal</title>
</head>
<body>
  <nav>
    <div class="links">
    <image src="Style/igootje.png" class="vvzaIcon"></image>
    <p>VVZA Portaal</p>
    </div>
    <div class="rechts">
    <ul>
      <li>
        <a class="active" href="index.php">Home</a>
        <a class="active" href="./Private/login.php">Login</a>
      </li>
    </ul>
    </div>
  </nav>

<div id="modal">
  <div id="modal-content">
    <div id="modal-head">
      <div id="modal-title">Voeg een afspraak toe</div>
      <button id="close" class="modal-close"><i class="fas fa-times"></i></button>
    </div>

    <div id="modal-body">
      break elements go <br><br><br><br><br><br> xd
    </div>
  </div>
</div>

  <div id="calendar">
    <form action="" method="POST">
      <div id="calendar-head">
        <button type="submit" name="previous" class="calendar-arrow"><i class="fas fa-arrow-left"></i></button>

        <div id="calendar-week">
          <?=$calendar->GetWeek()?>
          <button type="submit" name="reset" class="calendar-button"><i class="fas fa-calendar-check"></i></button>
        </div>

        <button type="submit" name="next" class="calendar-arrow"><i class="fas fa-arrow-right"></i></button>
      </div>
    </form>

    <div id="calendar-body">
      <?=$calendar->GetTasks()?>
    </div>

    <div id="calendar-foot">
      <button id="add" class="calendar-button"><i class="fas fa-plus"></i></button>
    </div>
  </div>
  <script src="Javascript/script.js"></script>
</body>
</html>
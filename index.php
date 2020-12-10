<?php
session_start();
date_default_timezone_set("Europe/Amsterdam");

function my_autoloader($class) {
    include 'Classes/' . $class . '.php';
}

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

$query = "";

function GetWeek() {
  $offset = $_SESSION["week_offset"];

  $week = intval(date("W", strtotime("{$offset} week")));
  $year = date("o", strtotime("{$offset} week")); // o haalt het jaar van de week. Y haalt het huidige jaar. We moeten nog bespreken welke we willen.
  
  return "Week {$week} - {$year}";
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Main.css">
    <script src="Javascript/script.js"></script>
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
  <div id="calendar">
    <form action="" method="POST">
      <div id="calendar-head">
        <button type="submit" name="previous" class="calendar-arrow"><i class="fas fa-arrow-left"></i></button>

        <div id="calendar-week">
          <?=GetWeek()?>
          <button type="submit" name="reset" class="calendar-button"><i class="fas fa-redo"></i></button>
        </div>

        <button type="submit" name="next" class="calendar-arrow"><i class="fas fa-arrow-right"></i></button>
      </div>
    </form>

    <div id="calendar-body">
      <div class="calendar-item">
        <div class="item-head">
          <div class="item-name">Jan</div>
          <div class="item-date">Maandag 6 januari 2020</div>
        </div>

        <div class="item-body">
          Vloer vegen
        </div>

        <div class="item-foot">
          <div>
            <label for="done1">Gedaan:</label>
            <input type="checkbox" name="done2" id="done1">
          </div>
        </div>
      </div>

      <div class="calendar-item">
        <div class="item-head">
          <div class="item-name">Kees</div>
          <div class="item-date">Dinsdag 7 januari 2020</div>
        </div>

        <div class="item-body">
          Tafels schoonmaken
        </div>

        <div class="item-foot">
          <div>
            <label for="done2">Gedaan:</label>
            <input type="checkbox" name="done2" id="done2">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
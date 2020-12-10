<?php
date_default_timezone_set("Europe/Amsterdam");
setlocale(LC_TIME, 'Dutch');

$_SESSION["test"] = "pizza";

var_dump($_SESSION["sessionid"]);
var_dump($_SESSION["loggedin"]);
var_dump($_SESSION["test"]);

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

$query = "";

function GetWeek() {
  $offset = $_SESSION["week_offset"];

  $week = intval(date("W", strtotime("{$offset} week")));
  $year = date("o", strtotime("{$offset} week")); // o haalt het jaar van de week. Y haalt het huidige jaar. We moeten nog bespreken welke we willen.
  
  return "Week {$week} - {$year}";
}
require_once('layout/Header.php') 
?>

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
  </div>
<?php require_once('layout/Footer.php') ?>
<?php
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
require_once('layout/Header.php') 
?>

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
<?php require_once('layout/Footer.php') ?>
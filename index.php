<?php
date_default_timezone_set("Europe/Amsterdam");
setlocale(LC_TIME, 'Dutch');

function my_autoloader($class)
{
    include 'Classes/' . $class . '.php';
}
include 'Classes/Calendar.php'; // autoloader ish broken :(

$calendar = new Calendar();
$offset = 0;

if (isset($_GET["week_offset"])) {
    $offset = htmlspecialchars($_GET["week_offset"]);
}

if (isset($_GET["previous"])) {
    $offset--;
}

if (isset($_GET["next"])) {
    $offset++;
}

if (isset($_GET["reset"])) {
    $offset = 0;
}

$query = "";

// function GetWeek()
// {
//     $offset = $_SESSION["week_offset"];
//
//     $week = intval(date("W", strtotime("{$offset} week")));
//     $year = date("o", strtotime("{$offset} week")); // o haalt het jaar van de week. Y haalt het huidige jaar. We moeten nog bespreken welke we willen.
//
//     return "Week {$week} - {$year}";
// }
require_once('layout/Header.php')
?>

  <div id="calendar">
    <form action="" method="GET">
      <input name="week_offset" type="hidden" value=<?=$offset?>>
      <div id="calendar-head">
        <button type="submit" name="previous" class="calendar-arrow"><i class="fas fa-arrow-left"></i></button>

        <div id="calendar-week">
          <?=$calendar->GetWeek($offset)?>
          <button type="submit" name="reset" class="calendar-button"><i class="fas fa-calendar-check"></i></button>
        </div>

        <button type="submit" name="next" class="calendar-arrow"><i class="fas fa-arrow-right"></i></button>
      </div>
    </form>

    <div id="calendar-body">
      <?=$calendar->GetTasks($offset)?>
    </div>
  </div>
<?php require_once('layout/Footer.php') ?>

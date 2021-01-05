<?php
require_once('Layout/Header.php');

// function my_autoloader($class) {
//     include 'Classes/' . $class . '.php';
// }
// include 'Classes/Calendar.php'; // autoloader ish broken :(

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
?>

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

    <div id="calendar-foot">
      <button id="add" class="calendar-button"><i class="fas fa-plus"></i></button>
    </div>
  </div>
<?php require_once('layout/Footer.php') ?>

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

if(isset($_POST['toevoegen'])){
    $startTime = htmlspecialchars($_POST['startTime']);
    $endTime = htmlspecialchars($_POST['endTime']);
    $date = htmlspecialchars($_POST['date']);
    $job = htmlspecialchars($_POST['job_choise']);
    $volunteer = htmlspecialchars($_POST['volunteer']);

    $user = (new add_job);

    $user->add_newjob($startTime, $endTime, $date, $job, $volunteer);
}
?>

<div id="modal">
  <div id="modal-content">
    <div id="modal-head">
      <div id="modal-title">Voeg een afspraak toe</div>
      <button id="close" class="modal-close"><i class="fas fa-times"></i></button>
    </div>

    <div id="modal-body">
        <form action="" method="POST">
            <div class="input-group">
                <label for="loginEmail">Begin tijd:</label>
                <input id="loginEmail" type="time" name="startTime" required>
            </div>
            <div class="input-group">
                <label for="loginEmail">Eind tijd:</label>
                <input id="loginEmail" type="time" name="endTime" required>
            </div>
            <div class="input-group">
                <label for="loginEmail">Datum:</label>
                <input id="loginEmail" type="date" name="date" required>
            </div>
            <div class="input-group">
                <label for="loginEmail">Wat voor dienst:</label>
                <select name="job_choise" id="cars">
                    <?php foreach(add_job::different_jobs() as $jobs) { ?>
                        <option value="<?=$jobs[0]?>"><?=$jobs[1]?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-group">
                <label for="loginEmail">Wie doet deze dienst:</label>
                <select name="volunteer" id="cars">
                    <?php foreach(add_job::volunteer() as $volunteer) { ?>
                        <option value="<?=$volunteer[0]?>"><?=$volunteer[2]?> <?=$volunteer[3]?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="button-container">
                <button type="submit" name="toevoegen" class="btn">done</button>
            </div>
        </form>
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
    <?php if (isset($_SESSION["role"]) == "2") { ?>
        <div id="calendar-foot">
        <button id="add" class="calendar-button"><i class="fas fa-plus"></i></button>
    <?php } ?>
  </div>
    
  </div>
<?php require_once('layout/Footer.php') ?>

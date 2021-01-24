<?php
  include("../Layout/header.php");
  if (!isset($_SESSION)) {
    session_start();
}
$calendar = new Calendar();
$offset = 0;
$deny = false;

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

$name = $_SESSION['name'];

if(!$_SESSION['name']){
  $deny = true;
  echo("Er is iets fout gegaan met het inloggen, probeer het opnieuw. U word over 5 seconden terug gestuurd.");
  header("refresh:6;url=login.php");
}

// toevoegen van een vrijwilliger voor in het rooster
if(isset($_POST['toevoegen'])){
    $startTime = htmlspecialchars($_POST['startTime']);
    $endTime = htmlspecialchars($_POST['endTime']);
    $date = htmlspecialchars($_POST['date']);
    $job = htmlspecialchars($_POST['job_choise']);
    $volunteer = htmlspecialchars($_POST['volunteer']);

    $user = (new add_job);

    $user->add_newjob($startTime, $endTime, $date, $job, $volunteer);
}

// verwijderen van een vrijwilliger uit het rooster
if (isset($_POST['verwijderen'])) {
    $id = htmlspecialchars($_POST['inputid']);

    $user = (new add_job);

    $user->delete_job($id);
}

if($deny == false){

?>

<div class="rightInfoDiv">
  <p class="welcomeUserMessage"> Welkom <?=$name?></p>
  hier komt de availibity te staan zodat de user makkelijk overzicht heeft.
</div>

<div id="modal">
  <div id="modal-content">
    <div id="modal-head">
      <div id="modal-title">Voeg een afspraak toe</div>
      <button id="close" class="modal-close"><i class="fas fa-times"></i></button>
    </div>

    <div id="modal-body">
        <form action="" method="POST">
            <div class="input-group">
                <label for="loginEmail">Wie doet deze dienst:</label>
                <select name="volunteer" id="cars">
                    <?php foreach(add_job::volunteer() as $volunteer) { ?>
                        <option value="<?=$volunteer[0]?>"><?=$volunteer[2]?> <?=$volunteer[3]?></option>
                    <?php } ?>
                </select>
            </div>
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
            <!-- kan uiteindelijk weg -->
            <div class="input-group">
                <label for="loginEmail">Wat voor dienst:</label>
                <select name="job_choise" id="cars">
                    <?php foreach(add_job::different_jobs() as $jobs) { ?>
                        <option value="<?=$jobs[0]?>"><?=$jobs[1]?></option>
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
            </div>
        <?php } ?>
    </div>
<?php
} 
?>
 
<?php require_once('../layout/Footer.php') ?>
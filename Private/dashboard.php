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
  <?php
} 
?>
 

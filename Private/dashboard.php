<?php
  include("../Layout/header.php");
  if (!isset($_SESSION)) {
    session_start();
}
$calendar = new Calendar();
$offset = 0;
$deny = false;

//$View = (new View());
//availability ophalen
$pdo = new PDO("mysql:host=127.0.0.1;dbname=vvza_database","root","");
$query = "SELECT * FROM availability a INNER JOIN user u ON a.user_id=u.user_id;";
$d = $pdo->query($query);

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
    <b>Hierbij wordt de aanwezigheid getoond van de vrijwilligers</b>
    <br>
<table border="" cellpadding="" cellspacing="" align="center">
    <tr>
        <th>Maandag</th>
        <th>Dinsdag</th>
        <th>Woensdag</th>
        <th>Donderdag</th>
        <th>Vrijdag</th>
        <th>Naam</th>
        <th>Achternaam</th>
    </tr>
    <?php foreach ($d as $data) { ?>
        <tr>
            <td><?php echo $data['monday']; ?></td>
            <td><?php echo $data['tuesday']; ?></td>
            <td><?php echo $data['wednesday']; ?></td>
            <td><?php echo $data['thursday']; ?></td>
            <td><?php echo $data['friday']; ?></td>
            <td><?php echo $data['first_name']; ?></td>
            <td><?php echo $data['last_name']; ?></td>
        </tr>
 <?php   }
?>
</table>
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
  <?php
} 
?>
 
<?php require_once('../layout/Footer.php') ?>
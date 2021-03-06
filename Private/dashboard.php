<?php
  include("../Layout/header.php");
  if (!isset($_SESSION)) {
    session_start();
}
$calendar = new Calendar();
$offset = 0;
$deny = false;

//availability ophalen.
$availability = (new Availability());
$datas = $availability->Fetch();

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
  
  <p class="welcomeUserMessage"> Welkom <?=$_SESSION['name']?></p>
  <b>Hierbij wordt de aanwezigheid getoond van de vrijwilligers</b>
  <div class="rightInfoContainer">
    <table class="table table-striped table-responsive-md btn-table">
        <thead class="font">
        <tr>
            <th scope="col">Naam</th>
<!--            <th scope="col">Achternaam</th>-->
            <th scope="col">Maandag</th>
            <th scope="col">Dinsdag</th>
            <th scope="col">Woensdag</th>
            <th scope="col">Donderdag</th>
            <th scope="col">Vrijdag</th>
            <th scope="col">Zaterdag</th>
            <th scope="col">Zondag</th>

        </tr>
        </thead>
        <tbody>
    <?php foreach ($datas as $data) { ?>
        <tr class="font-2">
            <td><?php echo $data['first_name'] . " " . $data['last_name'];?></td>
            <td><?php echo $data['monday']; ?></td>
            <td><?php echo $data['tuesday']; ?></td>
            <td><?php echo $data['wednesday']; ?></td>
            <td><?php echo $data['thursday']; ?></td>
            <td><?php echo $data['friday']; ?></td>
            <td><?php echo $data['saturday']; ?></td>
            <td><?php echo $data['sunday']; ?></td>

        </tr>
    <?php   }
    ?>
        </tbody>
    </table>
  </div>
  
</div>
<div id="modal">
  <div id="modal-content">
    <div id="modal-head">
      <div id="modal-title">Voeg een afspraak toe</div>
      <button id="close" class="modal-close"><i class="fas fa-times"></i></button>
    </div>

    <div id="modal-body">
        <form action="" method="POST">
          <div class="form-container">
            <label for="loginEmail">Wie doet deze dienst:</label>
            <select name="volunteer" id="cars">
                <?php foreach(add_job::volunteer() as $volunteer) { ?>
                    <option value="<?=$volunteer[0]?>"><?=$volunteer[2]?> <?=$volunteer[3]?></option>
                <?php } ?>
            </select>

            <label for="loginEmail">Begin tijd:</label>
            <input id="loginEmail" type="time" name="startTime" required>

            <label for="loginEmail">Eind tijd:</label>
            <input id="loginEmail" type="time" name="endTime" required>

            <label for="loginEmail">Datum:</label>
            <input id="loginEmail" type="date" name="date" required>
          </div>
          <div class="button-container">
            <button type="submit" name="toevoegen" class="btn btn-success">Toevoegen</button>
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
        <?php if($_SESSION["role"] == "2") { ?>
            <div id="calendar-foot" >
                <button id="add" class="calendar-button"><i class="fas fa-plus"></i></button>
            </div>
        <?php }else{} ?>

        </div>
  </div>

  <?php
} 
?>
 
<?php require_once('../layout/Footer.php') ?>
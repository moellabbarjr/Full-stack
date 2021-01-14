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

<div>
Mooie intro pagina maken
</div>

<?php require_once('layout/Footer.php') ?>

<?php
/**
 * Created by PhpStorm.
 * User: Shaqu
 * Date: 10-12-2020
 * Time: 13:07
 */
include("../Layout/Header.php");


$job = (new Job());
$job_title = $job->getJob();
$availability = (new Availability());

if(isset($_POST['availability'])){

    $monday = htmlspecialchars($_POST['mondayBeginTime']) . "," . htmlspecialchars($_POST['mondayEndTime']);
    $tuesday = htmlspecialchars($_POST['tuesdayBeginTime']) . "," . htmlspecialchars($_POST['tuesdayEndTime']);
    $wednesday = htmlspecialchars($_POST['wednesdayBeginTime']) . "," . htmlspecialchars($_POST['wednesdayEndTime']);
    $thursday = htmlspecialchars($_POST['thursdayBeginTime']) . "," . htmlspecialchars($_POST['thursdayEndTime']);
    $friday = htmlspecialchars($_POST['fridayBeginTime']) . "," . htmlspecialchars($_POST['fridayEndTime']);
    $saturday = htmlspecialchars($_POST['saturdayBeginTime']) . "," . htmlspecialchars($_POST['saturdayEndTime']);
    $sunday = htmlspecialchars($_POST['sundayBeginTime']) . "," . htmlspecialchars($_POST['sundayEndTime']);
    $job_preference = htmlspecialchars($_POST['job_p']);
    var_dump($availability->add($monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$job_preference));
}
?>
    <div class="container container-center">
        <div class="loginCard">
            <div class="title">
                <p>VVZA Vrijwilliger aanmelden</p>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="Monday">Maandag:</label>
                    <input id="datePerson" type="time" name="mondayBeginTime" placeholder="Incheck tijd">
                    <input id="datePerson" type="time" name="mondayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="Monday">Dinsdag:</label>
                    <input id="datePerson" type="time" name="tuesdayBeginTime" placeholder="Begin tijd">
                    <input id="datePerson" type="time" name="tuesdayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="Monday">Woensdag:</label>
                    <input id="datePerson" type="time" name="wednesdayBeginTime" placeholder="Begin tijd">
                    <input id="datePerson" type="time" name="wednesdayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="Monday">Donderdag:</label>
                    <input id="datePerson" type="time" name="thursdayBeginTime" placeholder="Begin tijd" >
                    <input id="datePerson" type="time" name="thursdayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="Monday">Vrijdag:</label>
                    <input id="datePerson" type="time" name="fridayBeginTime" placeholder="Begin tijd">
                    <input id="datePerson" type="time" name="fridayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="Monday">Zaterdag:</label>
                    <input id="datePerson" type="time" name="saturdayBeginTime" placeholder="Begin tijd">
                    <input id="datePerson" type="time" name="saturdayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="Monday">Zondag:</label>
                    <input id="datePerson" type="time" name="sundayBeginTime" placeholder="Begin tijd">
                    <input id="datePerson" type="time" name="sundayEndTime" placeholder="Eind tijd" >
                </div>
                <div class="input-group">
                    <label for="selectJob">Taken:</label>
                    <select id = "myList" name="job_p">
                        <?php foreach(Job::getJob() as $job) { ?>
                            <option value="<?=$job['job_id']?>"> <?= $job["job_title"]?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="button-container">
                    <button id="loginBtn" type="submit" name="availability" class="btn">Aanmelden</button>
                </div>
            </form>
        </div>
    </div>


<?php include("../Layout/Footer.php");?>
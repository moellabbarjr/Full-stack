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

<div>
  <p class="Hoofdtext">Home</p>

  <div class="con_banner">
    <img class="banner_home" src="Img/IMG_0009-768x5766.jpg" alt="">
      <p class="welkom_text" ><b>Welkom bij VVZA portaal</b></p>
  </div>

  <div class="grid-container">
    <div class="grid-item">
      <p>
        <b>VVZA Portaal</b>
        <p>Welkom bij het nieuwe VVZA portaal.<br>
         Op deze gloednieuwe website kunt u inloggen en een taak op u nemen. <br>
         Klik onderaan om het nieuwe portaal te ontdekken.<br><br>
         Veel succes! <br><br>
         <a href="../Private/login.php"><button type="button" name="login" class="btn-home">VVZA Portaal</button></a>
        
        </p>
      </p>

    </div>
    <div class="grid-item">
      <p>
        <b>Adres & Route</b> <br>
        Sportpark Emiclaer <br>
        Hoolesteeg 6, <br>
        3822 NC Amersfoort. <br>
<br>
         <b style="color:darkred; font-size:1rem;":>Let op:</b> <br>
            Met de auto kunt u sportpark Emiclaer, thuisbasis van VVZA, uitsluitend bereiken via de wijk Schothorst. <br>
            De parkeerplaats van ons sportpark kunt u het beste via de straat Nederhorst bereiken.
       
        </p>
      </p>
    </div>
</div>
<?php require_once('layout/Footer.php') ?>

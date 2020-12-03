<?php
function my_autoloader($class) {
    include '../Classes/' . $class . '.php';
}?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/Main.css">
    <title>VVZA Portaal</title>
</head>
<body>
<nav>
    <div class="links">
      <i class="fas fa-apple-alt"></i>
      <p>VVZA Portaal</p>
    </div>
    <div class="rechts">
    <ul>
      <li>
        <a class="active" href="../index.php">Home</a> |  
        <a class="active" href="login.php">Login</a>
      </li>
    </ul>
    </div>
  </nav>
</body>
</html>
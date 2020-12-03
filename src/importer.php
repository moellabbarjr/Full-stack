<?php

if (!isset($_SESSION)) {
    session_start();
}

// classes gaan automatisch zolang ze maar in het mapje class staan
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

// posts

// voorbeeld -> require_once('post/post.php');
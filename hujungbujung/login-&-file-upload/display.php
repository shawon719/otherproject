<?php
session_start();

if (!isset($_SESSION['mySession'])) {
    header('location:index.php');
}


include_once "nav.php";
include_once "class.php";
// include_once "registration.php";


Student::display();

echo "<div style='margin-top: 150px;'></div>";

require_once('footer.php');
?>
   
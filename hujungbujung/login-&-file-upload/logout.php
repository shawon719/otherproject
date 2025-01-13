<?php
    session_start();

    unset($_SESSION['mySession']);
    session_destroy();
    header('location:index.php');

?>
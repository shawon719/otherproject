<?php
    session_start();
    if(!isset($_SESSION["sname"])){
        header('location:indexlog.php');
    }
    echo "this is dashboard page."
?>
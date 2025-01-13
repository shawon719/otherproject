<?php
        session_start();
        unset($_SERVER["sname"]);
        session_destroy();
       
        header("location: login.php");
         
?>
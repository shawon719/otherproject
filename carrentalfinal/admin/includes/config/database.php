<?php
            $db=new mysqli("localhost","root","","carrental_database");
            if($db->connect_error){
                die("Connection failed" . $db->connect_error);
            }
            else{
                echo "Connect successfully.";
            }
?>
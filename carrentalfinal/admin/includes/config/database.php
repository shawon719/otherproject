<?php

                // db connection
            $db=new mysqli("localhost","root","","carrental_database");
                // check connection
            if($db->connect_error){
                die("Connection failed" . $db->connect_error);
            }
            else{
                echo "Connect successfully.";
            }
?>
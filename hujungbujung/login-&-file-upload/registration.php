<?php
    // logout session 
    session_start();

    if(!isset($_SESSION['mySession'])){
        header('location:index.php');
    }
    //  include class.php 
    require_once 'class.php';

    if(isset($_POST['btnSubmit'])){
        $name=$_POST['fullname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $course=$_POST['course'];

        if(!preg_match("/^[^ ]+@[a-z]+\.[a-z]{3,6}$/", $email)){
            $msg= "Email is not valid";
        }
        else if(!preg_match("/^[0-9]{10,14}$/", $phone)){
            $msg2= "Phone is not valid";
        }
        else{
            $myObject = new Student($name,$email,$phone,$address,$course);
            $myObject->save();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles/registration.css">
</head>
<body>

    <!-- includes nav file -->
    <?php
        require_once ('nav.php');

        echo isset($msg)?$msg:'';
        echo isset($msg2)?$msg2:'';
    ?>


    <div class="registration-container">
        <h2>Registration Form</h2>
        <form action="#" method="POST">
            <div class="input-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="username">Phone:</label>
                <input type="number" id="phone" name="phone" required>
            </div>
            <div class="input-group">
                <label for="password">address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="input-group">
                <label for="confirm-password">Course:</label>
                <input type="text" id="confirm-password" name="course" required>
            </div>
            <button type="submit" name="btnSubmit">Register</button>
        </form>
    </div>
    <?php
        require_once('footer.php');
    ?>
</body>
</html>

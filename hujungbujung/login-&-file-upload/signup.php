<?php

session_start();

require_once 'signupClass.php';

if (isset($_POST['btnSubmit'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password == $confirm_password) {
        // check old data 
        $file = file('loginData.txt');
        foreach ($file as $singleData) {
            list($signupName) = explode(',', trim($singleData));

            if (trim($name) == $signupName) {
                $msg = 'This user already exists';
            } else {
                // create a object 
                $myObject = new Signup($name, $password);
                $myObject->save();
                $_SESSION['mySession'] = $name;
                header('location:registration.php');
                break;
            }
        }
    }
    else{
        $msgPassword = 'Password are not same';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles/signup.css">
</head>

<body>
    <div class="signup-container">
        <form class="signup-form" action="#" method="post">
            <h2>Create an Account</h2>
            <?php
            echo isset($msgPassword) ? $msgPassword : '';
            echo isset($msg) ? $msg : '';

            ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
            </div>
            <button type="submit" name="btnSubmit">Sign Up</button>
            <p>Already have an account? <a href="index.php">Login here</a></p>
        </form>
    </div>
</body>

</html>
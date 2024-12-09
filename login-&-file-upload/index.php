<?php
    session_start();

    if(isset($_POST['btnSubmit'])){
        $name = $_POST['username'];
        $password = $_POST['password'];
       
        $file = file('loginData.txt');

        foreach($file as $singleData){
            list($userName, $userPassword)=explode(',',trim($singleData));
            if(trim($name) == $userName && trim($password) == $userPassword){
                $_SESSION['mySession'] = $name;
                header('location:registration.php');
            }
            else{
                $msg = 'User name or password Incorrect';
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- showing a massage  -->
         <?php
            echo isset($msg)?$msg:'';
         ?>

        <form action="#" method="POST">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required placeholder="badhon">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="123">
            </div>
            <button type="submit" name="btnSubmit">Login</button>
            <p class="forgot-password"><a href="signup.php">SignUp?</a></p>
        </form>
    </div>
</body>
</html>

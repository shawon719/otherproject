<?php 
        // session_start();

        // //form binding with php
        // // when signin button click then check email and password in database 
        // if(isset($_POST["btn"])){
        //     $email=$_POST["txtEmail"];
        //     $password=$_POST["txtPassword"];

        //     if($email=="name@gmail.com" && $password=="123"){
        //         $_SESSION["sname"]=$email;
        //         header("location:dashboard.php");
        //     }

        // }
   
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
    <!-- <style>
        body{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container{
            background-color: yellowgreen;
            padding: 30px;
            width: 100%;
            max-width: 450px;
            height: 400px;
            border-radius: 10px;
        }

        /* Styling for the close button */
.close-btn {
    position: relative;
    /* top: 5px;  */
    left: 370px; 
    
    /* padding-left: 380px; */
    /* padding-top: 1px; */
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
    color: #555;
}

.close-btn:hover {
    color: #f00;
    border: 1px solid white;
}
    </style>
    
</head>
<body>
    <!-- this is login page.which text file is index  .php 
    <div class="form-container">
            
        <form action="" method="post">
        <div class="">
                 <button class="close-btn" onclick="closeForm()"><b>×</b></button>
            </div>

        
            <div class="text-center">
                <h3>Log In</h3>
            </div>
            

            <!-- email section 
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" name="txtEmail" class="form-control" id="exampleFormControlInput1" placeholder="name@gmail.com">
            </div>

            <!-- password section 
             <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" name="txtPassword" id="inputPassword5" class="form-control" >
                    

             </div>

             <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" name="btn">Button</button>
               
            </div>
            


             </div>
        </form>
    </div>


    <script src="./bootstrap/js/adminlte.min.js"></script>
   
</body>
</html> -->

<?php 
    session_start();

    // Form binding with PHP
    // When signin button is clicked, check email and password in the database
    if (isset($_POST["btn"])) {
        $email = $_POST["txtEmail"];
        $password = $_POST["txtPassword"];

        // Basic login validation (hardcoded, for demonstration purposes)
        if ($email == "name@gmail.com" && $password == "123") {
            $_SESSION["sname"] = $email;
            header("location:dashboard.php");
            exit(); // To ensure no further code is executed after the redirect
        } else {
            $error_message = "Invalid email or password!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            box-sizing: border-box;
        }

        .form-container {
            background-color: yellowgreen;
            padding: 30px;
            width: 100%;
            max-width: 450px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            background: none;
            border: none;
            font-size: 30px;
            cursor: pointer;
            color: #555;
        }

        .close-btn:hover {
            color: red;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .form-container h3 {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn {
            border-radius: 5px;
            padding: 10px;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <button class="close-btn" onclick="closeForm()"><b>×</b></button>
        <form action="" method="post">
            <div class="text-center">
                <h3>Log In</h3>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Email section -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" name="txtEmail" class="form-control" id="exampleFormControlInput1" placeholder="name@gmail.com" required>
            </div>

            <!-- Password section -->
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" name="txtPassword" id="inputPassword5" class="form-control" required>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" name="btn">Sign In</button>
            </div>
        </form>
    </div>

    <script>
        // Close the form when the close button is clicked
        function closeForm() {
            window.close(); // This will attempt to close the window (works only in some browsers)
        }
    </script>

    <script src="./bootstrap/js/adminlte.min.js"></script>
</body>
</html>


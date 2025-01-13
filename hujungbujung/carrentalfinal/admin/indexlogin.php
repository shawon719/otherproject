<?php
        session_start();

        // include database and check connection
        include_once("./includes/config/database.php");
        $db=mysqli_connect("localhost","root","","carrental_database");
        if(!$db){
                throw new Exception("database connection failed" . mysqli_connect_error());
            }
            else{
                echo "connected successful.";
            }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>

    <!-- link pages -->
            <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
            <link rel="stylesheet" href="./bootstrap/fontawesome/css/all.min.css">
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

        /* .close-btn {
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
        } */

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
                <!-- <button class="close-btn" onclick="closeForm()"><b>×</b></button> -->
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
   
									
        <!-- bootstrap js -->
            <script src="./bootstrap/js/adminlte.min.js"></script>
</body>
</html>
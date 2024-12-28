
<?php 
        session_start();

        //form binding with php
        // when signin button click then check email and password in database 
        if(isset($_POST["btn"])){
            $email=$_POST["txtEmail"];
            $password=$_POST["txtPassword"];

            if($email=="name$gmail.com" && $password=="123"){
                $_SESSION["sname"]=$email;
                header("location:dashboard.php");
            }

        }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="./asstes/images/Pharmanest (1).png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
    <style>
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
    <!-- this is login page.which text file is index  .php -->
    <div class="form-container">
            
        <form action="" method="post">
        <div class="">
                 <button class="close-btn" onclick="closeForm()"><b>×</b></button>
            </div>

        
            <div class="text-center">
                <h3>Log In</h3>
            </div>
            

            <!-- email section -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" name="txtEmail" class="form-control" id="exampleFormControlInput1" placeholder="name@gmail.com">
            </div>

            <!-- password section -->
             <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" name="txtPassword" id="inputPassword5" class="form-control" >
                    <!-- <div id="passwordHelpBlock" class="form-text">
                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                     </div> -->

             </div>

             <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" name="btn">Button</button>
                <!-- <button class="btn btn-primary" type="button">Button</button> -->
            </div>
            


             </div>
        </form>
    </div>


    <script src="./bootstrap/js/adminlte.min.js"></script>
   
</body>
</html>

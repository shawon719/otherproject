<?php
    //session section start here.
    session_start();
    if(isset($_POST["btn"])){
        $username=$_POST["namefield"];
        $email=$_POST["emfield"];
        $password=$_POST["pafield"];
        if($username=="shawon" && $password=="shawon2001"){
            $_SESSION["sname"]=$username;
            header("location: demopage.php");
        }else{
            $m="username and password are incorrect";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in page</title>

    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
</head>
<body>
    <?php
            echo isset($m)?$m:"";
    ?>
        
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <div class="container-fluid">
    <a class="nav-link" href="#">HOME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="">
          <a class="nav-link" aria-current="page" href="#">REGISTRATION</a>
        </li>
        <li class="">
          <a class="nav-link" href="#">DETAILS</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Log out 
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Home</a></li>
            <li><a class="dropdown-item" href="#">Registration</a></li>
            <li><hr class="dropdown-divider">Details</li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <form action="#" method="post">
        <h1>Please enter following field then log in student information</h1>
        <div>
            Username:
            <input type="text" name="namefield" id="">
        </div><br>
        <div>
            Email:
            <input type="text" name="emfield" id="">
        </div><br>
        <div>
            Password:
            <input type="text" name="pafield" id="">
        </div><br>
        <div>
        <input type="submit" name="btn" value="submit">
        </div>
    </form>
    
</body>
</html>

<?php
        // session_start();
        // if(isset($_POST["btn"])){
        //     $username=$_POST["txtusername"];
        //     $password=$_POST["txtpassword"];
        //     $email=$_POST["emfield"];
        //     if($username=="admin" && $password=="123"){
        //         $_SESSION["rname"]=$username;
        //         header("location:registrationpage.php");
        //     }
        //     else{
        //         $msg="username or passwoed is incorrectE!";
        //     }
        // }

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>authenticaton </title>
</head>
<body>
        <?php
                echo isset($msg)?$msg:"";
        ?>
        <section id="forms">
            <form action="#" method="post">
                <div>
                        User Name: <br>
                        <input type="text" name="txtusername" id="n">
                </div>
                <div>
                    email:
                    <input type="text" name="emfield" id="">
                </div>
                <div>
                        Password: <br>
                        <input type="password" name="txtpassword" id="p">
                </div>
                 
                <div>
                        <input type="submit" name="btn" value="submit">
                </div>
            </form>
        </section>
    
</body>
</html> -->
<?php
            session_start();
            include('includes/config.php');
             // PDO connection setup
    try {
        $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new Exception('Database connection failed: ' . $e->getMessage());
    }

     // When the signin button is clicked
     if (isset($_POST['login'])) {
        // Retrieve form data and sanitize inputs
        $role = $_POST['user-roll'];
        $username = $_POST['username'];
        $password = $_POST['password'];
          // Check if all required fields are provided
          if ($username && $password && $role) {
            // Prepare the query to avoid SQL injection
                $sql="SELECT * FROM {$role} WHERE UserName=:username and Password=:password";
                $query= $dbh -> prepare($sql);
                $query-> bindParam(':username', $username, PDO::PARAM_STR);
                $query-> bindParam(':password', $password, PDO::PARAM_STR);
                $query-> execute();

                // Check if user exists
                if($query->rowCount() > 0){
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                         // Verify password (if not hashed, just compare plain password)
                        if ($password === $user['password']) {  // No hashing, plain password check 
                            $_SESSION['alogin'] = $role; // Store user data in session                       
                        // Redirect to dashboard
                        // header("Location: dashboard.php");
                        // exit(); // Ensure no further code executes
                        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
                    } else {
                        // Invalid password
                        // $msg = "Invalid email or password.";
                        echo "<script>alert('Invalid admin or password.');</script>";
                    }
            } 
            else {
                // User does not exist
                //$msg = "Invalid email or role.";
                echo "<script>alert('Invalid email or role.');</script>";
            }
        } 
        else {
           // $msg = "Please fill in all required fields.";
            echo "<script>alert('Please fill in all required fields.');</script>";
        }
    }                     
                        
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Car Rental Portal | Admin Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x" style="color:#fff">Admin | Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
                                <label for="" class="text-uppercase text-sm">Select Role </label>
                                <select name="user-roll" id="user-roll" class="form-select" required>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="salesman">Salesman</option>
                                </select><br><br>



									<label for="" class="text-uppercase text-sm">Your Username </label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">


                                            <?php //if (isset($msg)): ?>
                                                <!-- <div class="alert alert-danger" role="alert"> -->
                                                    <?php //echo $msg; ?>
                                                <!-- </div> -->
                                            <?php //endif; ?>

									<button class="btn btn-primary btn-block" name="login" type="submit">LOG IN</button>

								</form>

			<p style="margin-top: 4%" align="center"><a href="../index.php">Back to Home</a>	</p>
							</div>

						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>
	






	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>
</html>

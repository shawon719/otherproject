<?php
session_start();
include('includes/config.php');

$db = mysqli_connect("localhost","root","","carrental");
if(! $db){
	throw new Exception('Database connection failed: ' . mysqli_connect_error());
}

		// if(isset($_POST['login']))
		// {
		// $email=$_POST['username'];
		// $password=md5($_POST['password']);
		// $sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
		// $query= $dbh -> prepare($sql);
		// $query-> bindParam(':email', $email, PDO::PARAM_STR);
		// $query-> bindParam(':password', $password, PDO::PARAM_STR);
		// $query-> execute();
		// $results=$query->fetchAll(PDO::FETCH_OBJ);
		// if($query->rowCount() > 0)
		// {
		// $_SESSION['alogin']=$_POST['username'];
		// echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
		// } else{
		
		// echo "<script>alert('Invalid Details');</script>";

		// }
		// }

		if(isset($_POST["login"])){

			 // Retrieve form data and sanitize inputs
			 $role = mysqli_real_escape_string($db, $_POST['user-roll']);
			 $email = mysqli_real_escape_string($db, $_POST['username']);
			 $password = mysqli_real_escape_string($db, $_POST['password']);
		 
			 // Check if all required fields are provided
			 if ($email && $password && $role) {
				 $query = "SELECT * FROM {$role} WHERE UserName='{$email}' AND password='{$password}'LIMIT 1";
				 $user_result = mysqli_query($db, $query);
		 
				 // Check if query was successful and if data exists
				 if ($user_result && mysqli_num_rows($user_result) > 0) {
					 $user = mysqli_fetch_assoc($user_result); // Fetch user data
		 
					 // Store user data in session
					 $_SESSION['role'] = $role;
					 // $_SESSION['id'] = $user['id']; // Assuming your table has an 'id' column
					 
					 // Redirect to dashboard
					 header("Location: dashboard.php");
					 exit(); // Ensure no further code executes
				 } else {
					 // Invalid login credentials
					 $msg = "Invalid email, password, or role.";
				 }
			 } else {
				 $msg = "Please fill in all required fields.";
			 }
		 }
		 

		

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Car Admin Login main</title>
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
								<label for="user-roll" class="text-uppercase text-sm">Select Role</label>
									<select name="user-roll" id="user-roll" class="form-control mb" required>
										<option value="admin">Admin</option>
										<option value="manager">Manager</option>
										<option value="salesman">Salesman</option>
									</select><br>




									<label for="" class="text-uppercase text-sm">Your Username </label>
									<input type="text" placeholder="admin" name="username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Test@12345" name="password" class="form-control mb">


									 <!-- Error Message Display -->
									 <?php if (isset($msg)): ?>
										<div class="alert alert-danger" role="alert">
											<?php echo $msg; ?>
										</div>
           							 <?php endif; ?>

		

									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>

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
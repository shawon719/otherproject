<?php
// Start the session
session_start();

// Check if the user is logged in, else redirect to login.php
if (!isset($_SESSION["sname"])) {
    header("location: login.php");
    exit(); // Ensure no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo PHP</title>
</head>
<body>
    <!-- Link to another page -->
    <a href="datastorepage.php">datastore</a>

    <!-- Form for capturing user information -->
    <form action="#" method="post">
        <h1>registration page</h1>
        <div>
            ID: <br>
            <input type="text" name="txtId" id="">
        </div>
        <div>
            Name: <br>
            <input type="text" name="txtName">
        </div>
        <div>
            Email: <br>
            <input type="email" name="txtemail" id="">
        </div>
        <div>
            Password: <br>
            <input type="password" name="txtpassword" id="">
        </div>
        <div>
            Phone: <br>
            <input type="number" name="txtNumber" id="">
        </div>
        <div>
            <input type="submit" name="btn" value="Submit" id="">
        </div>
    </form>

    <!-- Logout link to end the session -->
    <a href="logout.php">Log out</a>
</body>
</html>

<?php
    session_start();
    if(!isset($_SESSION["sname"])){
        header('location:indexlog.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>This is my dashboard</h1>
</body>
</html>


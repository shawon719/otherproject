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
    <title>dashboard page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
    <link rel="stylesheet" href="./bootstrap/fontawesome/css/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
</head>


        <body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php 
         //include_once "include/nav.php";
        ?>
        <!--end::Header--> 
        <!--begin::Sidebar-->
        <?php 
         //include_once "include/sidebar.php";
        ?>
        <!--end::Sidebar--> <!--begin::App Main-->

    <!-- <h1>This is my dashboard</h1> -->
    <?php
         include("./includes/sidebar.php");
    ?>



     <script src="./bootstrap/js/adminlte.min.js"></script>
</body>
</html>


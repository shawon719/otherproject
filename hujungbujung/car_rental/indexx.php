<?php
    echo "this will be my front ,UI page.europcar";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index page</title>
    <link rel="stylesheet" href="./bootstrap//dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="./bootstrap/fontawesome/css/all.min.css">
     <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
    
     <script src="./bootstrap/fontawesome/js/all.min.js"></script>
     <style>
      body{
         background-image: url("asstes/img/back0.jpg");
        background-repeat: no-repeat;
        width: 100%;
        height: 100px; 
      }
      .header_component_right{
        -webkit-box-align: center;
      }
     </style>

</head>
<body>
   

  <?php
      include("./pages/indexheader.php");
  ?>


      
    <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/js/adminlte.min.js"></script>
</body>
</html>
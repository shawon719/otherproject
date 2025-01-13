<?php
   session_start();

   if(!isset($_SESSION['mySession'])){
       header('location:index.php');
   }
   

  if(isset($_POST['btnSubmit'])){
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $tmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $kb = $fileSize/1024;

    $img = 'images/';

      if($kb > 400){
        $msg = "File is too large. <br> Please input under 400kb file";
      }
      else{
         move_uploaded_file($tmpName,$img.$fileName);
         $msg1 = "Success";
      }
  }

?>

<!-- include nav file  -->
<?php
    require_once 'nav.php';
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload Form</title>
  <link rel="stylesheet" href="styles/imageUp.css">
</head>
<body>

  <div class="upload-form">

    <!-- showing a massage  -->
    <?php
      echo isset($msg)?$msg:'';
      echo isset($msg1)?$msg1:'';
    ?>

    <h1>Upload Your File</h1>
    <form action="#" method="post" enctype="multipart/form-data">
      <label for="file-upload" class="custom-file-upload">
        Choose File
      </label>
      <input type="file" id="file-upload" name="file">
      <button type="submit" name="btnSubmit">Upload</button>
    </form>
  </div>
  <?php
  echo "<div style='margin-top: 280px;'></div>";

    require_once('footer.php');
  ?>
</body>
</html>



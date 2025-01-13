<?php
 session_start();

 if(!isset($_SESSION['mySession'])){
     header('location:index.php');
 }

// include nav file 
require_once 'nav.php';

$imgLocation = 'images/';
$images = glob($imgLocation. "*{jpg,jpeg,png,gif}", GLOB_BRACE);
if(count($images)>0){
  foreach($images as $image){
    echo '<img src="'.$image. '" width=300px; height=300px; style="margin:5px; border:2px solid; border-radius: 8px;" alt="Uploaded Image">';
  }
}
else{
  echo "No image Uploaded yet!";
}

?>
<?php
        require_once('footer.php');
   ?>
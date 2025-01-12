<?php 
// DB credentials.
// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PASS','');
// define('DB_NAME','carrental');
// // Establish database connection.
// try
// {
// $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
// }
// catch (PDOException $e)
// {
// exit("Error: " . $e->getMessage());
// }


$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
//$store_url = "http://localhost/php-projects/pharmanest/";
// db connection
$db = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($db->connect_error) {
  die("Connection Failed : " . $db->connect_error);
} else {
  // echo "Successfully connected";
}



?>
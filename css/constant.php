<?php
//Start Session

session_start();




//Create constant ot strore non -repeating values
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');
define('SITEURL', 'http://localhost/FoodFactory/');

	
$con =  mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //connection

$db_select = mysqli_select_db($con,DB_NAME) or die(mysqli_error());

?>
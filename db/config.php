<?php 

session_start();

define('SITEURL','http://localhost:8080/food-order/');

define('LOCALHOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','food');


$conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD) or die(mysqli_error());

$db_select = mysqli_select_db($conn,DATABASE) or die(mysqli_error());

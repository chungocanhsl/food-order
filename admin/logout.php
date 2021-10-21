<?php 
include '../db/config.php';
//1.huy session
session_destroy();
//2. chuyen huong
header("Location: ".SITEURL."admin/login.php");
?>
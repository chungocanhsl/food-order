<?php 

//authorization - access control
//check whether the user is logged in or not
if(!isset($_SESSION['user'])) {
	//user is not logged in
	//redirect to login page
	$_SESSION['no-login-message'] = "
	<div class='error text-center'>Please login to access Admin Panel </div>
	";
	header("Location: ". SITEURL."admin/login.php");
	exit;
}
?>
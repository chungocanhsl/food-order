<?php 
include '../db/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Food Order</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center">Login</h1>
		<br><br>

<?php 
if(isset($_SESSION['login'])) {
	echo $_SESSION['login'];
	unset($_SESSION['login']);
}
if(isset($_SESSION['no-login-message'])) {
	echo $_SESSION['no-login-message'];
	unset($_SESSION['no-login-message']);
}
?>

		<!--Login start-->
		<form action="" method="post" class="text-center">
			Username:  <br>
			<input type="text" name="username" placeholder="Enter Username">
			<br><br>

			Password:<br>
			<input type="password" name="password" placeholder="Enter Password"><br><br>

			<input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
		</form>
		<!--Login end-->

		<p class="text-center">Created By - <a href="">AnhOkela</a></p>
	</div>
</body>
</html>

<?php 
//check whether the submit button is clicked or not
if(isset($_POST['submit'])) {
	//process login
	//1.get the data from login
	//$username = md5($_POST['username']);
	//$password = md5($_POST['password']);
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$raw_password = md5($_POST['password']);
	$password = mysqli_real_escape_string($conn,$raw_password);

	//2. sql to check
	$sql ="select * from tbl_admin where username='$username' and password='$password'";

	//3. execute query
	$result = mysqli_query($conn,$sql);

	//4. count rows to check whether the user exists or not
	$count = mysqli_num_rows($result);
	if($count==1) {
		//user oke
		$_SESSION['login'] = "<div class='success'>Login Successful</div>";
		$_SESSION['user'] = $username;//to check whether the user is logged in or not and logout will unset it
		header("Location: ".SITEURL."admin/");
	} else {
		//user not availabel
		$_SESSION['login'] = "<div class='error text-center'>
		Username or password did not match
		</div>";
		header("Location: ".SITEURL."admin/login.php");
	}
}
?>
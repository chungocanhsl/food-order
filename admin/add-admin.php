<?php 
include 'partials/menu.php';

?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>
		<br/><br/>

	<?php

	if(isset($_SESSION['add'])) {
	//checking whether the session is set of not
		echo $_SESSION['add'];
		unset($_SESSION['add']);
	} 
	?>
		<form action="" method="post">
			<table class="tbl-30">
				<tr>
					<td>Fullname: </td>
					<td><input type="text" name="fullname" placeholder="Enter the fullname"></td>
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" placeholder="Enter username"></td>
				</tr>

				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" placeholder="Enter password"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>


<?php
include 'partials/footer.php';
?>

<?php 
if(isset($_POST['submit'])) {

	//1.get the data from form
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	//2. sql query
	$sql = "insert into tbl_admin set 
	fullname = '$fullname',
	username='$username',
	password= '$password'
	";

	//3. execute query and save db
	$result = mysqli_query($conn,$sql) or die(mysqli_error());

	//3. check whether query is executed data is inserted or not and display
	
	if($result==true) {
		//data inserted
		//create a session variable to display message
		
		$_SESSION['add'] = "Admin added succesfully";
		header("Location: ".SITEURL.'admin/manage-admin.php');
		exit;
	} else {
		//failed insest
		$_SESSION['add'] = "Failed to add admin";
		header("Location: ".SITEURL.'admin/add-admin');
		exit;
	}
}
?>
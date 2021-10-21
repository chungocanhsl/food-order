	<?php
include 'partials/menu.php';

//include 'db/config.php'; ?>


<?php 
if(isset($_GET['id'])) {
	$id = $_GET['id'];

}
?>
<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br>
		<br>
		<form action="" method="post">
			<table class="tbl-30">
				<tr>
					<td>Current pasword: </td>
					<td><input type="password" name="current_password" placeholder="Current pasword"></td>
				</tr>

				<tr>
					<td>New pasword: </td>
					<td>
						<input type="password" name="new_password" placeholder="New pasword"></td>
				</tr>

				<tr>
					<td>Confirm password:</td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm pasword"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?=$id?>">
						<input type="submit" name="submit" value="Change Password" class="btn-secondary">
						
					</td>
				</tr>



			</table>
		</form>
	</div>
</div>

<?php 
if(isset($_POST['submit'])) {
	//1.get data tu form
	$id = $_POST['id'];
	$current_password = md5($_POST['current_password']);
	$new_password = md5($_POST['new_password']);
	$confirm_password = md5($_POST['confirm_password']);
	//2. check whether the user with cureent id and current password exist or not
	
	$sql = "select * from tbl_admin where id=$id and password= '$current_password'";

	//thuc thi query
	$result = mysqli_query($conn,$sql);
	if($result==true) {
		$count = mysqli_num_rows($result);
		if($count==1) {
			//user exist and password can be changed
			//echo 'user found';
			if($new_password==$confirm_password) {
				//update pw
				
				//echo "pwd oke";
				$sql2 = "update tbl_admin set
				password='$new_password' 
				where id=$id
				";
				//execute query
				$result2 = mysqli_query($conn,$sql2);
				if($result2==true) {
					//display success message
$_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";

			header("Location: ".SITEURL.'admin/manage-admin.php');
				}else {
					//display error message
$_SESSION['change-pwd'] = "<div class='error'>Failed to changed Password </div>";

			header("Location: ".SITEURL.'admin/manage-admin.php');
				}
			} else {
				//redirect ve trang kia
				$_SESSION['pwd-not-match'] = "<div class='error'>Password did not match </div>";

			header("Location: ".SITEURL.'admin/manage-admin.php');
			}
		} else {
			//user does not exist set message and redirect
			$_SESSION['user-not-found'] = "<div class='error'>User not found </div>";

			header("Location: ".SITEURL.'admin/manage-admin.php');
		}
	}
	//3. check weather the new password and confirm password match or not
	//4. change password if oke
}
?>


<?php 
include 'partials/footer.php';?>

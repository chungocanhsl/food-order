	<?php
include 'partials/menu.php';
//include 'db/config.php'; ?>

<div class="maincontent">
	<div class="wrapper">
		<h1>Update admin</h1>
		<br>
		<br>

<?php 
//1.get id
$id = $_GET['id'];

//2. create query
$sql = "select * from tbl_admin where id=$id";

//thuc thi query
$result = mysqli_query($conn,$sql);

if($result==true) {
	$count = mysqli_num_rows($result);
	if($count==1) {
		//get the details
		//echo "admin availabel";
		$row = mysqli_fetch_assoc($result);
		$fullname= $row['fullname'];
		$username=$row['username'];
		
	} else {
		//redirect to manage-admin
		
	header("Location: ".SITEURL.'admin/manage-admin.php');
	}

}

?>
		<form action="" method="post">
			<table class="tbl-30">
				<tr>
					<td>Full name: </td>
					<td><input type="text" name="fullname" placeholder="Enter you full name" value="<?= $fullname?>"></td>
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" placeholder="Enter you username" value="<?= $username?>"></td>
				</tr>

				
				<tr>
					<td colspan="2">
						<input hidden ="text" name="id" value="<?= $id?>">
						<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

	</div>
</div>


<?php 
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];

	//create sql query
	$sql = "update tbl_admin set 
	fullname = '$fullname',
	username= '$username'
	
	where id ='$id'
	";

	//execute query
	$result = mysqli_query($conn,$sql);

	if($result==true) {
		//query executed and admin updated
		
		$_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
		header("Location: ".SITEURL.'admin/manage-admin.php');
	} else {
		//failed to update admin
		$_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
		header("Location: ".SITEURL.'admin/manage-admin.php');
	}
}
?>

<?php
include 'partials/footer.php'; 
?>
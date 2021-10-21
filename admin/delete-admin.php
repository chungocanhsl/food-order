<?php 
include '../db/config.php'; 
//1. get id 
$id = $_GET['id'];
//2. tạo sql query
$sql = "delete from tbl_admin where id=$id";

//thuc thi query
$result = mysqli_query($conn,$sql);

//check whether the query executed success

if($result==true) {
	//query oke
	$_SESSION['delete'] = 
"<div class='success'>
	Admin Delete successfully 
	</div>";
	header('Location: '.SITEURL.'admin/manage-admin.php');
} else {
	//query failed
	$_SESSION['delete'] = "<dov class='error'>Failed to delete admin</div>";
	header('Location: '.SITEURL.'admin/manage-admin.php');
}

//3. redirect to manage admin page with message(success/error)

?>
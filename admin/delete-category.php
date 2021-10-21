<?php 
include '../db/config.php'; 
//check whether the id and image_name value is set or not
if(isset($_GET['id']) and isset($_GET['image_name'])){
	//get the value and delete
	$id = $_GET['id'];
	$image_name= $_GET['image_name'];
	//remove the physical image file is available
	if($image_name != "") {
		//image is availabel. so remove it
		$path = "../images/category/".$image_name;
		//remove the image
		$remove = unlink($path);


		//if falied to remove image then add an error message and stop the process
		if($remove==false) {
			//set the session message 
			$_SESSION['remove'] = "
			<div class='error'> failed to remove category image
			</div>
			"; 

			
			//redirect to manage category
			header("location: ". SITEURL."admin/manage-category.php");
			//stop the process
			die();

		}
	}

	//delete data from database
	$sql = "delete from tbl_category where id=$id";
	$result = mysqli_query($conn,$sql);
	if($result==true) {
		$_SESSION['delete'] = "
		<div class='success'>Category deleted successfully</div>";
		header("location: ".SITEURL."admin/manage-category.php");

	} else {
$_SESSION['delete'] = "
		<div class='error'> failed to delete category</div>";
		header("location: ".SITEURL."admin/manage-category.php");
	}

	//redirect 

} else {
	//redirect to manage category page
	header("location: ".SITEURL."admin/manage-category.php");
}
?>
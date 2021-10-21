<?php 
include '../db/config.php'; 
//check whether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name'])){
	//process to delete
	//1.get id and image name
	$id = $_GET['id'];
	$image_name= $_GET['image_name'];
	//2. remove the image if available
	if($image_name != "") {
		//image is availabel. so remove it
		$path = "../images/food/".$image_name;

		//remove the image
		$remove = unlink($path);


		//check whether the image is removed or not 
		if($remove==false) {
			//set the session message 
			$_SESSION['upload'] = "
			<div class='error'> failed to remove food image
			</div>
			"; 

			
			//redirect to food category
			header("location: ". SITEURL."admin/manage-food.php");
			//stop the process
			die();

		}
	}

	//3. delete data from database
	$sql = "delete from tbl_food where id=$id";
	$result = mysqli_query($conn,$sql);

	//4. redirect 
	if($result==true) {
		//food deleted
		$_SESSION['delete'] = "
		<div class='success'>
		Food deleted successfully</div>";
		header("location: ".SITEURL."admin/manage-food.php");

	} else {
		//failed to delete food
$_SESSION['delete'] = "
		<div class='error'> failed to delete food</div>";
		header("location: ".SITEURL."admin/manage-food.php");
	}

	

} else {

	//redirect to manage food page
	$_SESSION['unauthorize'] = "
		<div class='error'> Unauthorized access</div>";
	header("location: ".SITEURL."admin/manage-food.php");
}
?>
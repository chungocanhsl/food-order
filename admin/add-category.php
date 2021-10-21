<?php
include 'partials/menu.php';?>
<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>
		<br><br>
		<?php 

		if(isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if(isset($_SESSION['upload'])) {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

		?>
		<br><br>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title</td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>
				<tr>
					<td>Select Image</td>
					<td><input type="file" name="image_name"></td>
				</tr>
				<tr>
					<td>Featured</td>
					<td><input type="radio" name="featured" value="Yes">Yes
					<input type="radio" name="featured" value="No">No</td>
				</tr>

				<tr>
					<td>
						Active:
					</td>
					<td><input type="radio" name="active" value="Yes">Yes
					<input type="radio" name="active" value="No">No</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>
			</table>
			
		</form>

<?php 
//check whether the submit button is clicked or not 
if(isset($_POST['submit'])) {

//1. get the value from category form
$title = $_POST['title'];

//for radio input, we need to check whether the button is selected or not
if(isset($_POST['featured'])) {
	//get the value from form 
	$featured = $_POST['featured'];
} else {
	//set the default value
	$featured ="No";
}

if(isset($_POST['active'])) {
	$active = $_POST['active'];
} else {
	$active = "No";
}

//check whether the image is selected or not and set the value for image name
//print_r($_FILES['image_name']);

if(isset($_FILES['image_name']['name'])) {
	//upload the image
	//to upload image we need image name, source path and destination path
	$image_name = $_FILES['image_name']['name'];

	//upload the image only if image is selected
	if($image_name != "") {



	//auto rename our image 
	//get the extension of our image(img,png,gif,etc) vd: special.food1.jpg
	$ext = end(explode('.', $image_name));

	//rename the image
	$image_name="Food_Category_".rand(000,999).'.'.$ext;

	$source_path = $_FILES['image_name']['tmp_name'];
	$destination_path = "../images/category/".$image_name;
	
	//finally upload the image
	$upload = move_uploaded_file($source_path, $destination_path);

	//check whether the image is uploaded or not
	//and if the image is not upload then we will stop the process and redirect with error msg
	if($upload==false) {
		//set message
		$_SESSION['upload'] = "<div class='error'>Failed to upload image</div>
		";
		//redirect to add category
		header("Location: ".SITEURL."admin/add-category.php");
		//stop the process
		die();
	}
}
} else {
	//don't upload image and set the image_name value as blank
	$image_name="";
}


//2. create sql to insert
$sql = "insert into tbl_category set
	title='$title',
	image_name='$image_name',
	featured= '$featured',
	active= '$active'
";

//3. execute query
$result = mysqli_query($conn,$sql);
//4. check whether the query executed or not and data added or not 
if($result == true) {
	//query executed and category added
	$_SESSION['add'] = "
	<div class='success'>
	Category Added successfully
	</div>
	";
	//redirect to manage category page
	header("Location: ".SITEURL."admin/manage-category.php");
} else {
	//failed to add category
	$_SESSION['add'] = "
	<div class='error'>
	Falid to add category
	</div>
	";
	//redirect to manage category page
	header("Location: ".SITEURL."admin/add-category.php");
}

}
?>

	</div>
</div>


<?php 
include 'partials/footer.php';
?>
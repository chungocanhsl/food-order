<?php 
include 'partials/menu.php'; ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>
		<br><br>

		<?php 
		if(isset($_SESSION['upload'])) {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}
		?>
<br><br>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title </td>
					<td><input type="text" name="title" placeholder="Title of the food"></td>
				</tr>

				<tr>
					<td>Description</td>
					<td>
					<textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price</td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>

				<tr>
					<td>Select Image</td>

					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
<select name="category">
<?php 
//create code to display categories from db
//1. create sql to get all active categories
$sql = "select * from tbl_category where active='Yes'";

//execute query
$result = mysqli_query($conn,$sql);

//count rows to check whether we have categories
$count = mysqli_num_rows($result);

//if count is greater than 0, we have categories else we don't have categories

if($count>0) {
	while ($row=mysqli_fetch_assoc($result)) {
		//get the details of categories
		$id = $row['id'];
		$title = $row['title'];
		
		?>
        <option value="<?= $id?>"><?= $title?></option>



		<?php

	}

} else {
	//k co 
	?>

	<option value="0">No category found</option>

<?php 
}


//2. display on dropdown
?>




</select>
					</td>
				</tr>

				<tr>
					<td>Featured</td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No

					</td>
				</tr>

				<tr>
					<td>Active</td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No

					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>


			</table>
		</form>

<?php 
//check whether the button is clicked or not 
if(isset($_POST['submit'])) {
	//add the food in database
	//1. get the data from form
	$title = $_POST['title'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$category = $_POST['category'];

	//check whether radio button for featured and active are checked or not
	if(isset($_POST['featured'])) {
		$featured = $_POST['featured'];
	} else {
		$featured = "No";//default value
	} 
	if(isset($_POST['active'])) {
		$active = $_POST['active'];
	}else {
		$active = "No";
	}

	//2. upload the image if selected
	//check whether the select image is clicked or not and upload 
	if(isset($_FILES['image']['name'])) {
		//get the details of the selected image
		$image_name = $_FILES['image']['name'];

		//check whether the image is selected or not and upload image only if selected
		
		if($image_name != "") {
			//image is selected
			//A. rename the image
			//get the extension of selected image(jpg,png,gif, etc)
			$ext = end(explode('.', 
				$image_name));

			//create new name for image
			$image_name = "Food-Name-".rand(0000,9999).".".$ext;


			//B. upload the image
			//get the src path and destination path
			
			//source path is the current location of the image
			$src = $_FILES['image']['tmp_name'];

			//destination path for the image to be uploaded
			$dst = "../images/food/".$image_name;

			//finally upload the food image
			$upload = move_uploaded_file($src, $dst);

			//check whether image uploaded of not
			if($upload == false) {
				//failed to upload the immage
				//redirect 
				$_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
				header("Location: ".SITEURL."admin/manage-food.php");
				//stop the process
				die();
			}
		}
	} else {
		$image_name = "";//default valus as blank
	}
	
	//3. insert into database
	
	//create a sql to save
	$sql2 = "
	insert into tbl_food set 
	title = '$title',
	description = '$description',
	price = $price,
	image_name = '$image_name',
	category_id = $category,
	featured = '$featured',
	active = '$active'

	";

	//execute query
	$result2 = mysqli_query($conn,$sql2);
	

	//check whether data inserted or not 
	////4. redirect with msg to manage-food page
	if($result2 == true) {
		//data inserted successfully
		$_SESSION['add'] = "<div class='success'>Fodd Addes successfully </div>";
		header("location: ".SITEURL."admin/manage-food.php");
	} else {
		//failed to insert data
		$_SESSION['add'] = "<div class='error'>failed to add food</div>";
		header("location: ".SITEURL."admin/manage-food.php");
	}
	
}
?>		
	</div>
</div>


<?php
include 'partials/footer.php';
?>
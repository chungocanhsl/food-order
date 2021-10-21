<?php
include 'partials/menu.php';
?>
<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>
		<br><br>
<?php 
//check whether the id is set or not
if(isset($_GET['id'])) {
	//get the id and all other details
	$id = $_GET['id'];
	//sql query to get the selected food
	$sql2 = "select * from tbl_food where id=$id";
	$result2 = mysqli_query($conn,$sql2);
	
	$count2 = mysqli_num_rows($result2);
	
		//get all the data
		$row2 = mysqli_fetch_assoc($result2);


		//get the individual values of selected food
		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$current_image = $row2['image_name'];
		$current_category = $row2['category_id'];
		$featured = $row2['featured'];
		$active = $row2['active'];
		
	
	
} else {
	//redirect to manage food
	header("location: ".SITEURL."admin/manage-food.php");
}
?>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="tbl-30">
			<tr>
				<td>
					Title
				</td>
				<td><input type="text" name="title" value="<?= $title?>" placeholder="Food title goes here"></td>
			</tr>
			
			<tr>
				<td>Description</td>
				<td>
					<textarea name="description" cols="30" rows="5"><?= $description?></textarea>
				</td>
			</tr>

			<tr>
				<td>Price</td>
				<td>
					<input type="number" name="price" value="<?= $price ?>">
				</td>
			</tr>
			<tr>
				<td>Current Image</td>
				<td>
					<?php
	if($current_image == "") {
						//image not available
echo "<div class='error'>Image not available</div>";
					} else {
						//image available
						?>
<img src="<?= SITEURL?>images/food/<?= $current_image?>" alt="" width="200px">

						<?php
					} 
					?>
				</td>
			</tr>

			<tr>
				<td>Select the imgae</td>
				<td><input type="file" name="image"></td>
			</tr>

			<tr>
				<td>Category</td>
				<td>

<select name="category">
	<?php
	//query to get active categories
	$sql = "select * from tbl_category where active='Yes'";
	//execute query
	$result = mysqli_query($conn,$sql);

	//count rows
	$count = mysqli_num_rows($result);

	if($count>0) {
		//category available
		while ($row=mysqli_fetch_assoc($result)) {
			$category_title = $row['title'];
			$category_id = $row['id'];
			?>
			<option
			<?php if($current_category==$category_id) {
				echo "selected";
			} ?>
			 value="<?= $category_id?>">
				<?=$category_title?></option>




			<?php
			
			
		}
	} else {
		//category not available
		echo "<option value='0'>
		Category not available</option>";
	}
	?>
	
</select>
				</td>
			</tr>


			<tr>
				<td>Featured</td>
				<td>
					<input <?php 
					if($featured=="Yes") {
						echo "checked";
					}
					?> type="radio" name="featured" value="Yes">Yes
				<input <?php if($featured=="No") {
						echo "checked";
					} ?> type="radio" name="featured" value="No">No</td>
			</tr>
			<tr>
				<td>Active</td>
				<td><input <?php if($active=="Yes") {
						echo "checked";
					} ?> type="radio" name="active" value="Yes">Yes
				<input <?php if($active=="No") {
						echo "checked";
					} ?> type="radio" name="active" value="No">No</td>
			</tr>

			<tr>
					<td>
						<input type="hidden" name="id" value="<?= $id?>">
	<input type="hidden" name="current_image" value="<?= $current_image ?>">
	
	<input type="submit" name="submit" value="Update Food" class="btn-secondary">
					</td>
				</tr>

		</table>
		</form>
<?php 
if(isset($_POST['submit'])) 
{
	//1. get all the values from our form
	$id   = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$current_image = $_POST['current_image'];
	$category = $_POST['category'];
	$featured= $_POST['featured'];
	$active = $_POST['active'];

	//2. upload image
	//check whether the image is selected or not
	if(isset($_FILES['image']['name'])) 
	{

		$image_name= $_FILES['image']['name'];//new image name

		//check whether the image is available or not 
		if($image_name != "") 
		{
			//image available
			//A. upload image
			$ext = end(explode('.', $image_name));

			//rename the image
			$image_name="Food_Name_".rand(0000,9999).'.'.$ext;

			$src_path = $_FILES['image']['tmp_name'];
			$dest_path = "../images/food/".$image_name;
	
			// upload the image
			$upload = move_uploaded_file($src_path, $dest_path);

			//check whether the image is uploaded or not
	
			if($upload==false) 
			{
				//set message failed to upload
				$_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";
				//redirect to add food
				header("Location: ".SITEURL."admin/manage-food.php");
				//stop the process
				die();
			}
			//B. remove the current image
			if($current_image != "") 
			{
				//current image available
				$remove_path = "../images/food/".$current_image;

				$remove = unlink($remove_path);

				
	
				if($remove==false) 
				{
					//faild to remove image
					$_SESSION['remove-failed']="<div class='error>failed to remove current image</div>";
					header("location: ". SITEURL."admin/manage-food.php");
					die();
				} 
			}
		}
		else {
$image_name = $current_image;//default image when image is not selected
		}

		
	} 
	else 
		{
			$image_name = $current_image;//default image when button is not clicked
		}
 

	//3. update the database
	$sql3 = "UPDATE tbl_food SET
			title = '$title',
			description= '$description',
			price = $price,
			image_name = '$image_name',
			category_id = '$category',
			featured = '$featured',
			active ='$active'
			where id = $id";

	$result3 = mysqli_query($conn,$sql3);


	if($result3 == true) 
	{
		//category updated
		$_SESSION['update'] ="
		<div class='success'>Food Updated successfully</div>";
		header("Location: ".SITEURL."admin/manage-food.php");
	} 
	else 
	{
		//failed to update category
		$_SESSION['update'] ="
		<div class='error'>failed to update food </div>";
		header("Location: ".SITEURL."admin/manage-food.php");
	}

}
			

			

		?>
	</div>
</div>

		
<?php 
include 'partials/footer.php'; 

?>
<?php
include 'partials/menu.php';
?>
<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>
		<br><br>
<?php 
//check whether the id is set or not
if(isset($_GET['id'])) {
	//get the id and all other details
	$id = $_GET['id'];
	//sql
	$sql = "select * from tbl_category where id=$id";
	$result = mysqli_query($conn,$sql);
	//count the rows to check whether the id is valid or not
	$count = mysqli_num_rows($result);
	if($count==1) {
		//get all the data
		$row = mysqli_fetch_assoc($result);
		$title = $row['title'];
		$current_image = $row['image_name'];
		$featured = $row['featured'];
		$active = $row['active'];
		
	} else {
		//redirect to manage category with session message
		$_SESSION['no-category-found'] ="<div class='error'>Category not found</div>";
		header("Location: ".SITEURL."admin/manage-category.php");
	}
	
} else {
	//redirect to manage category
	header("location: ".SITEURL."admin/manage-category.php");
}
?>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="tbl-30">
			<tr>
				<td>
					Title
				</td>
				<td><input type="text" name="title" value="<?= $title?>"></td>
			</tr>
			<tr>
				<td>Current Image</td>
				<td>
					<?php 
					if($current_image != "") {
						//display the image
						?>

						<img src="<?= SITEURL?>images/category/<?=$current_image ?>" alt="" width="200px">

						<?php 
					} else {
						//hien thong bao
						echo "<div class='error'>Image not added</div>";
					}
					?>
					</td>
			</tr>
			<tr>
				<td>New Image</td>
				<td><input type="file" name="image"></td>
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
						<input type="hidden" name="current_image" value="<?= $current_image ?>">
						<input type="hidden" name="id" value="<?= $id?>">
						<input type="submit" name="submit" value="Update Category" class="btn-secondary">
					</td>
				</tr>

		</table>
		</form>
		<?php 
		if(isset($_POST['submit'])) {
			//1. get all the values from our form
			$id=$_POST['id'];
			$title=$_POST['title'];
			$current_image = $_POST['current_image'];
			$featured= $_POST['featured'];
			$active = $_POST['active'];

			//2. upload image
			//check whether the image is selected or not
			if(isset($_FILES['image']['name'])) {
				//get the image details
				$image_name= $_FILES['image']['name'];

				//check whether the image is available or not 
				if($image_name != "") {
					//image available
					//A. upload the new image
				//auto rename our image 
	//get the extension of our image(img,png,gif,etc) vd: special.food1.jpg
	$ext = end(explode('.', $image_name));

	//rename the image
	$image_name="Food_Category_".rand(000,999).'.'.$ext;

	$source_path = $_FILES['image']['tmp_name'];
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
		header("Location: ".SITEURL."admin/manage-category.php");
		//stop the process
		die();
	}
					//B. remove the current image
				if($current_image != "") {
					$remove_path = "../images/category/".$current_image;
				$remove = unlink($remove_path);

				//check whether the image is removed or not 
				//if faild then display msg and stop process
				if($remove==false) {
					//faild to remove image
					$_SESSION['failed-remove']="<div class='error>failed to remove current image</div>";
					header("location: ". SITEURL."admin/manage-category.php");
					die();
				} 
				}
				

				} else {
					$image_name = $current_image;
				}
			} else {
				$image_name = $current_image;
			}

			//3. update the database
			$sql2 = "update tbl_category set
			title='$title',
			image_name= '$image_name',
			featured= '$featured',
			active='$active'
			where id=$id
			";
			//execute the query 
			$result2 = mysqli_query($conn,$sql2);
			//4. redirect to manage category with message
			//check whether executed or not 
			if($result2 == true) {
				//category updated
				$_SESSION['update'] ="
				<div class='success'>Category Updated</div>
				";
				header("Location: ".SITEURL."admin/manage-category.php");
			} else {
				//failed to update category
				$_SESSION['update'] ="
				<div class='error'>faild to update Category </div>
				";
				header("Location: ".SITEURL."admin/manage-category.php");
			}

		}
			

			

		?>
	</div>
</div>

<?php 
include 'partials/footer.php'; 

?>
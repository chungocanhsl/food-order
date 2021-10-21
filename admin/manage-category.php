<?php
include 'partials/menu.php'; 

?>
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Category</h1>
			<br/><br/><br/>
<?php 

		if(isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if(isset($_SESSION['remove'])) {
			echo $_SESSION['remove'];
			unset($_SESSION['remove']);
		}
		if(isset($_SESSION['delete'])) {
			echo $_SESSION['delete'];
			unset($_SESSION['delete']);
		}
		if(isset($_SESSION['no-category-found'])) {
			echo $_SESSION['no-category-found'];
			unset($_SESSION['no-category-found']);
		}

		if(isset($_SESSION['update'])) {
			echo $_SESSION['update'];
			unset($_SESSION['update']);
		}
		if(isset($_SESSION['upload'])) {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

		if(isset($_SESSION['failed-remove'])) {
			echo $_SESSION['failed-remove'];
			unset($_SESSION['failed-remove']);
		}
		?>
		<br><br>


			<a href="<?= SITEURL?>admin/add-category.php" class="btn-primary">Add Category</a>

			<br/><br/><br/>
			<table class="tbl-full">
				<tr>
					<th>STT</th>
					<th>Title</th>
					<th>Image</th>
					<th>
						Featured
					</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

<?php 
//query to get all categories from database
$sql = "select * from tbl_category";

//execute query
$result=mysqli_query($conn,$sql);

//count rows
$count = mysqli_num_rows($result);

//create serial number variable and assign value as 1;
$sn = 1; 

//check whether we have data in database or not 
if($count>0) {
	//we have data in database
	
	while($row=mysqli_fetch_assoc($result)) {
		$id= $row['id'];
		$title = $row['title'];
		$image_name = $row['image_name'];
		$featured= $row['featured'];
		$active = $row['active'];
		?>

		<tr>
					<td><?= $sn++?></td>
					<td>
						<?= $title?>
						
					</td>

					<td>
						<?php 
						if($image_name != "") {
							//hiện ảnh
							?>
							<img src="<?= SITEURL?>/images/category/<?= $image_name?>" alt="" width="200px">


							<?php
						} else {
							//hiện thông báo
							echo "<div class='error'>Image not added</div>";

						}
						?>
					</td>
					<td><?= $featured?></td>
					<td><?= $active?></td>
					<td>
						<a href="<?= SITEURL ?>admin/update-category.php?id=<?= $id ?>" class="btn-secondary">Update Category 
						</a>
						<a href="<?= SITEURL ?>admin/delete-category.php?id=<?= $id ?>&image_name=<?=$image_name ?>" class="btn-danger">Delete Category 
						</a>
					</td>
				</tr>

		<?php 

	}
	
}else {
	//don;t hava data
	//we will display the message inside table
	?>
	<tr>
		<td colspan="6">
			<div class="error">
				No category Added
			</div>

		
		</td>	
	</tr>

	<?php 
}
?>

				

			

				
			</table>
		</div>
		
	</div>

<?php
include 'partials/footer.php'; 
?>
	
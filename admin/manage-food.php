<?php
include 'partials/menu.php';

?>
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Food</h1>
			<br/><br/><br>
<?php 

		if(isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}

		if(isset($_SESSION['delete'])) {
			echo $_SESSION['delete'];
			unset($_SESSION['delete']);
		}

		if(isset($_SESSION['upload'])) {
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}
		if(isset($_SESSION['unauthorize'])) {
			echo $_SESSION['unauthorize'];
			unset($_SESSION['unauthorize']);
		}

		if(isset($_SESSION['update'])) {
			echo $_SESSION['update'];
			unset($_SESSION['update']);
		}
		?>
<br><br>
			<a href="<?= SITEURL?>admin/add-food.php" class="btn-primary">Add Food</a>

			<br/><br/><br/>
			<table class="tbl-full">
				<tr>
					<th>STT</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php 
				//create sql query to get all the food
				$sql = "select * from tbl_food";
				$result = mysqli_query($conn,$sql);

				$count = mysqli_num_rows($result);
				$sn = 1;

				if($count>0) {
					while ($row=mysqli_fetch_assoc($result)) {
						$id = $row['id'];
						$title = $row['title'];
						$price = $row['price'];
						$image_name = $row['image_name'];
						$featured= $row['featured'];
						$active = $row['active'];
						?>

<tr>
					<td><?= $sn++ ?></td>
					<td><?= $title ?></td>
					<td>$<?= $price ?></td>
					<td>
						<?php
						//check whether we have image or not
						if($image_name== "") {
							//don' have image, display error msg
							echo "<div class='error'>Image not added</div";
						} else {
							//co anh
							?>

<img src="<?php echo SITEURL ?>images/food/<?= $image_name ?>" alt="" width="200px">


							<?php 
						} 
						?>
						
							
						</td>
					<td><?= $featured ?></td>
					<td><?= $active ?></td>
					<td>
						<a href="<?= SITEURL?>admin/update-food.php?id=<?= $id ?>" class="btn-secondary">Update Food 
						</a>
						<a href="<?= SITEURL?>admin/delete-food.php?id=<?= $id ?>&image_name=<?= $image_name?>" class="btn-danger">Delete Food 
						</a>
					</td>
				</tr>

						<?php 
					}

				} else {
					echo "<tr><td colspan='7' class='error'>Food not added yet</td></tr>";
				}

				?>

				

			
				
			</table>
		</div>
		
	</div>

<?php
include 'partials/footer.php'; 
?>
	
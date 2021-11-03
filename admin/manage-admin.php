	<?php
include 'partials/menu.php';
//include 'db/config.php'; 
?>
	



	<!----Main Content Section start----->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Admin</h1>
			<br/><br/><br/>

			<?php
			if(isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			} 

			if(isset($_SESSION['delete'])) {
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			} 
			if(isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			} 
			if(isset($_SESSION['user-not-found'])) {
				echo $_SESSION['user-not-found'];
				unset($_SESSION['user-not-found']);
			} 

			if(isset($_SESSION['pwd-not-match'])) {
				echo $_SESSION['pwd-not-match'];
				unset($_SESSION['pwd-not-match']);
			} 
			if(isset($_SESSION['change-pwd'])) {
				echo $_SESSION['change-pwd'];
				unset($_SESSION['change-pwd']);
			} 

			?>

			<br><br>

			<a href="add-admin.php" class="btn-primary">Add Admin</a>

			<br/><br/><br/>
			<table class="tbl-full">
				<tr>
					<th>STT</th>
					<th>Fullname</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>

				<?php 

				//query to get all admin
				$sql = "select * from tbl_admin";
				//thuc thi query
				$result = mysqli_query($conn,$sql);

				//check whether the query is excuted of not
				if($result==true) {
					//count rows 
					$count = mysqli_num_rows($result);//ham lay tat ca rows tu database

					$sn=1; //tao 1 bien;

					//check the num of rows
					if($count>0) {
						//co du lieu
						while($rows= mysqli_fetch_assoc($result
						)) {
							$id = $rows['id'];
							$fullname= $rows['fullname'];
							$username = $rows['username'];

							//hien thi du lieu ra bang 
							//?>
							<tr>
					<td><?=$sn++;?></td>
					<td><?= $fullname;?></td>
					<td><?= $username;?></td>
					<td>
						<a href="<?php echo SITEURL?>admin/update-password.php?id=<?= $id ?>" class="btn-primary">Change password</a>
						<a href="<?php echo SITEURL?>admin/update-admin.php?id=<?= $id ?>" class="btn-secondary">Update Admin
						</a>
						<a href="<?php echo SITEURL?>admin/delete-admin.php?id=<?= $id ?>" class="btn-danger">Delete Admin
						</a>
					</td>
				</tr>
							

<?php 
						}

					}else {
						//khong co du lieu
					}

				}
				?>

				

				
			</table>

		</div>
	</div>

	<!----Main Content Section end----->



	<!-----Footer start ----->
		<?php
include 'partials/footer.php'; 
?>
	
	<!-----Footer end----->
</body>
</html>
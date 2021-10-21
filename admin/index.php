<?php
include 'partials/menu.php'; 
//include 'db/config.php';
?>
	


	<!----Main Content Section start----->
	<div class="main-content">
		<div class="wrapper">
			<h1>DASHBOARD</h1>
			<?php 
if(isset($_SESSION['login'])) {
	echo $_SESSION['login'];
	unset($_SESSION['login']);
}
?>
<br><br>

			<div class="col-4 text-center">
				<?php
				$sql = "select * from tbl_category";
				$result = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($result);

				?>
				<h1><?= $count ?></h1>
				<br/>
				Categories
			</div>

			

			<div class="col-4 text-center">
				<?php
				$sql2 = "select * from tbl_food";
				$result2 = mysqli_query($conn,$sql2);
				$count2 = mysqli_num_rows($result2);

				?>
				<h1><?= $count2 ?></h1>
				<br/>
				Foods
			</div>

			<div class="col-4 text-center">
				<?php
				$sql3 = "select * from tbl_order";
				$result3 = mysqli_query($conn,$sql3);
				$count3 = mysqli_num_rows($result3);

				?>
				<h1><?= $count3?></h1>
				<br/>
				Total Orders
			</div>

			<div class="col-4 text-center">
				<?php
				$sql4 = "select sum(total) as Total from tbl_order where status='Delivered'";

				$result4 = mysqli_query($conn,$sql4);

				$row4 = mysqli_fetch_assoc($result4);

				$total_revenue = $row4['Total'];

				?>
				<h1>$<?=$total_revenue?></h1>
				<br/>
				Revenue Generated
			</div>

			<div class="clearfix">
				
			</div>
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
<?php
include 'partials/menu.php'; 
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Order</h1>
		<br><br>
<?php 
if(isset($_GET['id'])) {
	//get the order details
	
	$id = $_GET['id'];

	//get all other details based on this id
	//sql query to get the order details 
	
	$sql = "select * from tbl_order where id=$id";
	$result = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if($count == 1) {
		//detail available
		
		$row=mysqli_fetch_assoc($result);

		$food = $row['food'];
		$price = $row['price'];
		$qty = $row['qty'];
		$status = $row['status'];
		$customer_name = $row['customer_name'];
		$customer_contact = $row['customer_contact'];
		$customer_email = $row['customer_email'];
		$customer_address = $row['customer_address'];


	}else {
		//detail not available
		//redirect to manage order
	header("location: ".SITEURL."admin/manage-order.php");
	}
} else {
	//redirect to manage order
	header("location: ".SITEURL."admin/manage-order.php");
}
?>
		<form action="" method="post">
			<table class="tbl-30">
				<tr>
					<td>Food name</td>
					<td><b><?= $food?></b></td>
				</tr>

				<tr>
					<td>Price</td>
					<td><b>$ <?= $price?></b></td>
				</tr>

				<tr>
					<td>Qty</td>
					<td><input type="number" name="qty" value="<?= $qty?>"></td>
				</tr>

				<tr>
					<td>Status</td>
					<td>
	<select name="status">
		<option <?php if($status=="Ordered") {echo "selected"; }?> value="Ordered">Ordered</option>
		<option <?php if($status=="On Delivery") {echo "selected"; }?> value="On Delivery">On Delivery</option>
		<option <?php if($status=="Delivered") {echo "selected"; }?> value="Delivered">Delivered</option>
		<option <?php if($status=="Cancelled") {echo "selected"; }?> value="Cancelled">Cancelled</option>
	</select>
					</td>
				</tr>

				<tr>
					<td>Custormer Name</td>
					<td><input type="text" name="customer_name" 
					value="<?= $customer_name?>"></td>
				</tr>

				<tr>
					<td>Custormer Contact</td>
					<td><input type="text" name="customer_contact" value="<?= $customer_contact?>"></td>
				</tr>

				<tr>
					<td>Custormer Email</td>
					<td><input type="text" name="customer_email" value="<?= $customer_email?>"></td>
				</tr>

				<tr>
					<td>Custormer Address</td>
					<td><textarea name="customer_address" cols="30" rows="5"><?= $customer_address?></textarea></td>
				</tr>

				<tr>
					<td colspan="2"
					>
					<input type="hidden" name="id" value="<?= $id ?>">
					<input type="hidden" name="price" value="<?= $price ?>">
						<input type="submit" name="submit" value="Update Order" class="btn-secondary">
					</td>
				</tr>

			</table>
		</form>
<?php 
//check whether update button is clicked or not 
if(isset($_POST['submit'])) {
	//get all the values from form 
	$id = $_POST['id'];
	$price = $_POST['price'];
	$qty = $_POST['qty'];
	$total = $price * $qty;
	$status = $_POST['status'];

	$customer_name = $_POST['customer_name'];
	$customer_contact = $_POST['customer_contact'];
	$customer_email = $_POST['customer_email'];
	$customer_address = $_POST['customer_address'];
	

	//update the values
	$sql2 = "UPDATE tbl_order SET
	qty = $qty,
	total = $total,
	status = '$status',
	customer_name = '$customer_name',
	customer_contact = '$customer_contact',
	customer_email = '$customer_email',
	customer_address = '$customer_address'
	where id=$id 
	";

	//execute query 
	$result2 = mysqli_query($conn,$sql2); 

	//check whether update or not 
	//and redirect to manage-order
	
	if($result2==true) {
		//updated
		$_SESSION['update'] = "<div class='success'>Order Updated successfully</div>";
		header("location: ".SITEURL."admin/manage-order.php");

	}else {
		//failed to update
		$_SESSION['update'] = "<div class='error'>Failed to update order</div>";
		header("location: ".SITEURL."admin/manage-order.php");
	}
	
}
?>
	</div>
</div>






<?php
include 'partials/footer.php'; 

?>
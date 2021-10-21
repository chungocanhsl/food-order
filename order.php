<?php 
include "partials-front/menu.php";
?>

<?php 
//check whether food id is set or not
if(isset($_GET['food_id'])) {
    //get the food id and details the selected food 
    $food_id = $_GET['food_id'];

    //get the details of the selected food 
    $sql = "select * from tbl_food where id=$food_id";

    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    if($count==1) {
        //have data
        //get the data from db
        
        $row=mysqli_fetch_assoc($result);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //food not available
        //redirect to homepage
        header("location: ".SITEURL);
    }


} else {
    //redirect to homepage 
    header("location: ".SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

          <div class="food-menu-img">
            <?php
            if($image_name=="") {
                //image food not available
                echo 
        "<div class='error'>Image food not available</div>";

            }else {
                ?>
 <img src="<?= SITEURL?>images/food/<?= $image_name?>" alt="" class="img-responsive img-curve">


                <?php 
            }
            ?>
    
          </div>
    
                    <div class="food-menu-desc">
                        <h3><?= $title?></h3>
                        <input type="hidden" name="food" value="<?=$title?>">
                        <p class="food-price">$<?= $price?></p>
                        <input type="hidden" name="price" value="<?= $price?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

    <?php
    if(isset($_POST['submit'])) {
        //get all the details from the form
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d h:i:sa");

        $status = "Ordered"; //ordered, on delivery, delivered, cancelled

        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];


        //save the order in database 
        //sql 
        $sql2 = "insert into tbl_order set
        food = '$food',
        price = $price, 
        qty = $qty, 
        total = $total,
        order_date = '$order_date',
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address' 

        ";

        //execute query 
        $result2 = mysqli_query($conn,$sql2);

        if($result2==true) {
            //query oke and save in database 
            $_SESSION['order'] = "<div class='success text-center'>Food orderd successfully</div>";
            header("location: ".SITEURL);
        }else {
            //failed to save order
            $_SESSION['order'] = "<div class='error'>Failed to order food</div>";
            header("location: ".SITEURL);
        }


        
        
    } 
    ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
include "partials-front/footer.php";
?>
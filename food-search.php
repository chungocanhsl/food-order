<?php 
include "partials-front/menu.php";
?>

    <!--food-search-->
    <section class="food-search text-center">
        <div class="container">
            <?php
            $search = mysqli_real_escape_string($conn,$_POST['search']); 
            ?>
            <h2>Món ăn bạn tìm kiếm <a href="#" class="text-white">"<?= $search?>"</a></h2>

        </div>
    </section>
    <!-- food-search end-->



    <!-- food menu-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Thực đơn món ăn</h2>
<?php 
//get the search keyword
$search = $_POST['search'];

//sql query to get food based on search keyword 
$sql = "select * from tbl_food where title like '%$search%' or description like '%$search%'";

$result = mysqli_query($conn,$sql);

$count = mysqli_num_rows($result);

if($count > 0) {
    //food available
    //
    while ($row=mysqli_fetch_assoc($result)) {
        //get the details
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];

        ?>
<div class="food-menu-box">
                <div class="food-menu-img">
    <?php
    if($image_name=="") {
        //image not available
        echo 
        "<div class='error'>Image not available</div>";
    }else {
        //image oke
        ?>
  <img src="<?= SITEURL ?>images/food/<?= $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">


        <?php 
    }
    ?>
                  
                </div>

                <div class="food-menu-desc">
                    <h4><?= $title?></h4>
                    <p class="food-price">$<?= $price?></p>
                    <p class="food-detail">
                        <?= $description?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>




        <?php 
    }
} else {
    //food not available
     echo 
        "<div class='error'>
            <h3>Can't find food</h3>
           
        </div>";

}
?>
            



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- food-menu-->

    <?php 
include "partials-front/footer.php";
?>
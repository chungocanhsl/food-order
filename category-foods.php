<?php 
include "partials-front/menu.php";

//check whether id is passed or not 
if(isset($_GET['category_id'])) {
    //category id is set and get the id 
    $category_id = $_GET['category_id'];

    //get the category title based on category id 
    $sql = "select title from tbl_category where id =$category_id";

    $result = mysqli_query($conn,$sql);

    //get the value from db
    $row = mysqli_fetch_assoc($result);

    //get the title 
    $category_title = $row['title'];
} else {
    //category not passed 
    //redirect to home page
    header("location:".SITEURL."");
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?= $category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
<?php 
//create sql query to get foods based on selected category
$sql2 = "select * from tbl_food where category_id = $category_id";

$result2 = mysqli_query($conn,$sql2);

$count2 = mysqli_num_rows($result2);

if($count2 > 0) {
    while($row2=mysqli_fetch_assoc($result2)) {
        $id = $row2['id'];
        $title = $row2['title'];
        $price = $row2['price'];
        $description = $row2['description'];
        $image_name = $row2['image_name'];

        ?>
 <div class="food-menu-box">
        <div class="food-menu-img">

            <?php 
            if($image_name=="") {
                //image not available
                echo 
        "<div class='error'>image food not available</div>";

            }else {
                //image oke
                //?>


     <img src="<?= SITEURL ?>images/food/<?= $image_name?>" alt="" class="img-responsive img-curve">

                <?php
            }
            ?>
          
                </div>

     <div class="food-menu-desc">
          <h4><?= $title ?></h4>
              <p class="food-price">$<?= $price ?></p>
         <p class="food-detail">
                      <?= $description ?>
                    </p>
                    <br>

                    <a href="<?= SITEURL?>order.php?food_id=<?= $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


        <?php 

    }

}else {
    //food not available
     echo 
        "<div class='error'>food not available</div>";
}
?>
           

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php 
include "partials-front/footer.php";
?>
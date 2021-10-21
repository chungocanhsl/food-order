<?php 
include "partials-front/menu.php";
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?= SITEURL?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
    <?php 
    $sql = "select * from tbl_food where active='Yes'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

    if($count > 0) {
        //food available
        while ($row=mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price= $row['price'];
            $image_name = $row['image_name'];

            ?>
  <div class="food-menu-box">
      <div class="food-menu-img">

        <?php
        if($image_name=="") {
            //image not available
             echo 
        "<div class='error'>Food not available</div>";
        } else {
            //image available
            ?>

 <img src="<?= SITEURL?>images/food/<?= $image_name?>" alt="" class="img-responsive img-curve">

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

             <a href="<?= SITEURL?>order.php?food_id=<?= $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>




            <?php
            
        }
    } else {
        //food not available
        echo 
        "<div class='error'>Food not found</div>";
    }
    ?>

          

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php 
include "partials-front/footer.php";
?>
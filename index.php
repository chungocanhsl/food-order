<?php 
include "partials-front/menu.php";
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?= SITEURL?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Nhập tên món ăn" required>
                <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    } 
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore foods</h2>
    <?php
    //create sql query to display categories from db
    $sql = "select * from tbl_category where active='Yes' and featured = 'Yes' limit 6";


    //execute query
    $result = mysqli_query($conn,$sql);


    $count = mysqli_num_rows($result);

    if($count > 0) 
    {
        //categories available
        while($row=mysqli_fetch_assoc($result)) {
            //get the value like  id, title, image_name,
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];

            ?>

            <a href="<?=SITEURL?>category-foods.php?category_id=<?= $id?>">
            <div class="box-3 float-container">
                <?php
                    //check whether image is available or not
                    if($image_name== "") {
                        echo "<div class='error'>Image not available</div>";
                    } else {
                    //image available
                ?>
                    <img src="<?= SITEURL?>images/category/<?= $image_name?>" alt="" class="img-responsive img-curve">


                    <?php 
                }
                ?>
                

                <h3 class="float-text text-white"><?= $title ?></h3>
            </div>
            </a>



            <?php
        }

    } else {
        //categories not available
        echo 
        "<div class='error'>Category not added</div>";
    }
    ?>

            

          

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
<?php
//getting foods from db that are active and featured
$sql2 = "select * from tbl_food where active='Yes' and featured='Yes'";

$result2 = mysqli_query($conn,$sql2);

$count2 = mysqli_num_rows($result2);

if($count2 > 0) {
    //food available
    while ($row=mysqli_fetch_assoc($result2)) {
        //get all the values
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];

        ?>

<div class="food-menu-box">
     <div class="food-menu-img">
        <?php 
        //check whether image available or not
        if($image_name=="") {
            //image not available
             echo 
        "<div class='error'>Image Food not available</div>";
        } 
        else {
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
        "<div class='error'>Food not available</div>";
}
?>

            

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See all the foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php 
include "partials-front/footer.php";
?>
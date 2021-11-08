<?php 
include "./partials-front/menu.php";
?>


    <!-- categories-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Danh mục các món ăn hấp dẫn</h2>
            <h3 class="text-center">Không thể chối từ</h3>

            <?php
            //display all the categories that are active
            $sql = "select * from tbl_category where active = 'Yes'";
            $result = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($result);

            if($count>0) {
                //categories available
                while ($row=mysqli_fetch_assoc($result)) {
                    //get the values
                    $id = $row['id'];
                    $title= $row['title'];
                    $image_name = $row['image_name'];

                    ?>

                   <a href="<?=SITEURL?>category-foods.php?category_id=<?= $id?>">
            <div class="box-3 float-container">
                <?php 
                if($image_name == "") {
                    //image not available
                echo "<div class='error'>Image not found</div>";
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
        "<div class='error'>Category not found</div>";
            }
            ?>

            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories end -->

<?php 
include "partials-front/footer.php";
?>
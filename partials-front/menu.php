<?php 
include "db/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order food now!!!</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?= SITEURL?>" title="Logo">
                    <img src="images/logo.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?= SITEURL?>">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?= SITEURL?>categories.php">Danh mục</a>
                    </li>
                    <li>
                        <a href="<?= SITEURL?>foods.php">Món ăn hấp dẫn</a>
                    </li>
                    <li>
                        <a href="">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
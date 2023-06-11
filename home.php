<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = "0";
    }

    include 'components/_wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Home</title>
    
    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- swiper cdn css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    
    <!-- coustome css link -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- coustome css link for mobile-->
    <!-- <link rel="stylesheet" href="css/style_phone.css"> -->
    
    <style>
        <?php include 'css/style_phone.css'; ?>
    </style>

</head>
<body>
    
    <?php include 'components/_header.php'; ?>
    
    <!-- Home swiper section start -->
    
    <div class="home-bg">
        <section class="swiper home-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-1.png" alt="image 01">
                    </div>
                    <div class="content">
                        <span>upto 50% off</span>
                        <h3>latest smartphone</h3>
                        <a href="shop.php" class="btn">Shop Now</a>
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-2.png" alt="image 01">
                    </div>
                    <div class="content">
                        <span>upto 70% off</span>
                        <h3>latest watch</h3>
                        <a href="shop.php" class="btn">Shop Now</a>
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/home-img-3.png" alt="image 01">
                    </div>
                    <div class="content">
                        <span>upto 90% off</span>
                        <h3>latest headphone</h3>
                        <a href="shop.php" class="btn">Shop Now</a>
                    </div>
                </div>

            </div>
            <div class="swip-btn swiper-button-next"></div>
            <div class="swip-btn swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </section>
    </div>
    
    <!-- Home swiper section end -->

    
    <!-- Home category section start -->
    
    <section class="home-category">
        <h1 class="heding">Shop by category</h1>
        <div class="swiper category-slider">
            <div class="swiper-wrapper">
                
                <a href="category.php?category=laptop" class="swiper-slide slide" >
                    <img src="images/icon-1.png" alt="laptop">
                    <h3>laptop</h3>
                </a>
                <a href="category.php?category=tv" class="swiper-slide slide" >
                    <img src="images/icon-2.png" alt="tv">
                    <h3>smart tv</h3>
                </a>
                <a href="category.php?category=camera" class="swiper-slide slide" >
                    <img src="images/icon-3.png" alt="camera">
                    <h3>camera</h3>
                </a>
                <a href="category.php?category=mouse" class="swiper-slide slide" >
                    <img src="images/icon-4.png" alt="mouse">
                    <h3>mouse</h3>
                </a>
                <a href="category.php?category=fridge" class="swiper-slide slide" >
                    <img src="images/icon-5.png" alt="fridge">
                    <h3>fridge</h3>
                </a>
                <a href="category.php?category=washing" class="swiper-slide slide" >
                    <img src="images/icon-6.png" alt="washing">
                    <h3>washing machine</h3>
                </a>
                <a href="category.php?category=smartphone" class="swiper-slide slide" >
                    <img src="images/icon-7.png" alt="smartphone">
                    <h3>smartphone</h3>
                </a>
                <a href="category.php?category=watch" class="swiper-slide slide" >
                    <img src="images/icon-8.png" alt="watch">
                    <h3>watch</h3>
                </a>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Home category section end -->
    
    
    <!-- Home products section start -->
    
    <section class="home-products">
        <h1 class="heding">latest products</h1>
        <div class="swiper products-slider">
            <div class="swiper-wrapper">

            <?php
                $select_products = "SELECT * FROM `products` LIMIT 6";
                $products_result = mysqli_query($conn, $select_products);
                $num_row_products = mysqli_num_rows($products_result);
                if ($num_row_products > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($products_result)) {
            ?>

                <form action="" method="post" class="swiper-slide slide">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">
                    <button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
                    <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                    <img src="upload_images/<?= $fetch_products['image_01']; ?>" alt="image 01" class="image">
                    <div class="name"><?= $fetch_products['name']; ?></div>
                    <div class="flex">
                        <div class="price">Rs- <span><?= $fetch_products['price']; ?></span>/-</div>
                        <input type="number" name="qty" class="qty" min="1" max="9" value="1" onkeypress="if(this.value.length == 1) return false;">
                    </div>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="btn">
                </form>

            <?php
                    }
                }else {
                    echo '<p class="empty">No products avelable now!</p>';
                }
            ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Home products section end -->
    
    <?php include 'components/_footer.php'; ?>
    
    
    
    
    <!-- swiper cdn js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".home-slider", {
            spaceBetween: 30,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 9000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
        var swiper = new Swiper(".category-slider", {
            spaceBetween: 30,
            loop: true,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                slidesPerView: 2,
                },
                768: {
                slidesPerView: 3,
                },
                1024: {
                slidesPerView: 4,
                },
            },
        });
        var swiper = new Swiper(".products-slider", {
            spaceBetween: 30,
            loop: true,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                slidesPerView: 2,
                },
                768: {
                slidesPerView: 2,
                },
                1024: {
                slidesPerView: 3,
                },
            },
        });
    </script>

    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->
    
    <script>
        <?php include 'js/script.js'; ?>

        window.onload = function() {
            history.replaceState("", "", "home.php");
        }
    </script>

</body>
</html>
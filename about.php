<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = "0";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | About</title>

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
    
    <!-- about section start -->

    <section class="about">
        <div class="row">
            <div class="image">
                <img src="images/about-img.svg" alt="about">
            </div>
            <div class="content">
                <h3>Why choose us?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod eligendi temporibus id odio accusamus. Unde necessitatibus, itaque asperiores voluptatem quae vitae soluta tempora hic accusamus maiores architecto totam odit ab blanditiis, voluptatum id magnam!</p>
                <a href="contact.php" class="btn">Contact us</a>
            </div>
        </div>
    </section>

    <!-- about section end -->

    <!-- reviews section start -->

    <section class="reviews">
        <h1 class="heding">Client's reviews</h1>

        <div class="review-slider swiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="images/pic-1.png" alt="client">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab, iure.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>jony deep</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="images/pic-2.png" alt="client">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab, iure.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>margo robert</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="images/pic-3.png" alt="client">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab, iure.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>chalse deco</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="images/pic-4.png" alt="client">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab, iure.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>nastia docovich</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="images/pic-5.png" alt="client">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab, iure.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>sunil thapar</h3>
                </div>
                <div class="swiper-slide slide">
                    <img src="images/pic-6.png" alt="client">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab, iure.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>mio kisida</h3>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- reviews section end -->

    
    
    
    
    <?php include 'components/_footer.php'; ?>

    <!-- swiper cdn js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".review-slider", {
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
    </script>

</body>
</html>
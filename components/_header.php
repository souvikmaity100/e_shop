<!-- message and alert section start -->
<?php
if (isset($message)) {
    echo '<div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove()"></i>
        </div>';
   }
?>
<!-- message and alert section end -->

<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><span>E</span>-Shop</a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="orders.php">Orders</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>
        </nav>

        <div class="icons">
            <?php
                $select_wishlist_item = "SELECT * FROM `wishlist` WHERE user_id = $user_id";
                $select_wishlist_result = mysqli_query($conn, $select_wishlist_item);
                $number_of_wishlist = mysqli_num_rows($select_wishlist_result);

                $select_cart_item = "SELECT * FROM `cart` WHERE user_id = $user_id";
                $select_cart_result = mysqli_query($conn, $select_cart_item);
                $number_of_cart = mysqli_num_rows($select_cart_result);
            ?>

            <a href="search_page.php"><i class="fas fa-search"></i></a>
            <a href="wishlist.php" id="heart"><i class="fas fa-heart"></i><span>(<?= $number_of_wishlist ?>)</span></a>
            <a href="cart.php" id="shopping-cart"><i class="fas fa-shopping-cart"></i><span>(<?= $number_of_cart ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <div class="profile">
            <?php
                if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true){
                    $user_id = $_SESSION['user_id'];
                    $user_sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
                    $user_result = mysqli_query($conn, $user_sql);
                    $user_profile = mysqli_fetch_assoc($user_result);
            ?>
                <p id="user_name">
                    <?php echo $user_profile['name']; ?>
                </p>
                <a href="update_user.php" class="btn">Update profile</a>
                <a href="components/_logout.php" onclick="return confirm('Do you want to logout from this website ?')" class="delete-btn">Logout</a>
            <?php     
                }
                else{
            ?>
                <p>Please login first!</p>
                <div class="flex-btn">
                    <a href="login.php" class="option-btn">Login</a>
                    <a href="register.php" class="option-btn">Register</a>
                </div>
            <?php
            }
            ?>
            
        </div>
    </section>
</header>
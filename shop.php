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
    <title>E-Shop | Shop</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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
    
    <!-- shop section start -->

    <section class="products">
        <h1 class="heding">latest product</h1>
        <div class="box-container">
            <?php
                $select_products = "SELECT * FROM `products`";
                $products_result = mysqli_query($conn, $select_products);
                $num_row_products = mysqli_num_rows($products_result);
                if ($num_row_products > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($products_result)) {
            ?>

                <form action="" method="post" class="box">
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
                    echo '<p class="empty">No products found!</p>';
                }
            ?>
        </div>
    </section>

    <!-- shop section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
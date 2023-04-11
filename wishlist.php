<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];

        // -------------Delete item-------------
        if (isset($_POST['delete'])) {
            $pid = $_POST['pid'];
            $delete_sql = "DELETE FROM `wishlist` WHERE user_id = '$user_id' AND pid = '$pid'";
            $delete_result = mysqli_query($conn, $delete_sql);
            if ($delete_result) {
                $message = "Item deleted!";
            }
        }
        // -------------Delete all item-------------
        if (isset($_GET['delete_all'])) {
            $delete_all_sql = "DELETE FROM `wishlist` WHERE user_id = '$user_id'";
            $delete_all_result = mysqli_query($conn, $delete_all_sql);
            if ($delete_all_result) {
                header('location: wishlist.php');
            }
        }
    }
    else{
        $user_id = "0";
        header('location: home.php');
    }
    
    include 'components/_wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Wishlist</title>

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
    
    <!-- wishlist section start -->

    <section class="products">
        <h1 class="heding">your wishlist</h1>
        <div class="box-container">
            <?php
                $select_wishlist = "SELECT * FROM `wishlist` WHERE `user_id` = '$user_id'";
                $result_wishlist = mysqli_query($conn, $select_wishlist);
                $num_row_wishlist = mysqli_num_rows($result_wishlist);
                $grand_total = 0;
                if ($num_row_wishlist > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($result_wishlist)) {
                        $grand_total += $fetch_products['price'];
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_products['pid']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                <button type="submit"  name="delete" onclick="return confirm('Delete this item from wishlist?');" class="fas fa-trash-can"></button>
                <a href="quick_view.php?pid=<?= $fetch_products['pid']; ?>" class="fas fa-eye"></a>
                <img src="upload_images/<?= $fetch_products['image']; ?>" alt="image" class="image">
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
                    echo '<p class="empty">your wishlist is empty</p>';
                }
            ?>

        
        </div>
        <div class="wishlist-total">
            <div class="grand-total">Grand total : Rs- <span><?= $grand_total ?></span>/-</div>
            <a href="shop.php" class="option-btn">Continue shopping</a>
            <a href="wishlist.php?delete_all" onclick="return confirm('Delete all item from wishlist?');" class="delete-btn <?= ($grand_total > 1)? '' : 'disabled'?>">Delete All</a>
        </div>
    </section>

    <!-- wishlist section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
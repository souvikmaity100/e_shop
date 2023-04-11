<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];

        // -------------Delete item-------------
        if (isset($_POST['delete'])) {
            $pid = $_POST['pid'];
            $delete_sql = "DELETE FROM `cart` WHERE user_id = '$user_id' AND pid = '$pid'";
            $delete_result = mysqli_query($conn, $delete_sql);
            if ($delete_result) {
                $message = "Item deleted!";
            }
        }
        // -------------Delete all item-------------
        if (isset($_GET['delete_all'])) {
            $delete_all_sql = "DELETE FROM `cart` WHERE user_id = '$user_id'";
            $delete_all_result = mysqli_query($conn, $delete_all_sql);
            if ($delete_all_result) {
                header('location: cart.php');
            }
        }
        // -------------Update Quantity-------------
        if (isset($_POST['update_qty'])) {
            $qty = $_POST['qty'];
            $pid = $_POST['pid'];
            $update_qty = "UPDATE `cart` SET `quantity` = '$qty' WHERE `user_id` = '$user_id' AND `pid` = '$pid'";
            $qty_result = mysqli_query($conn, $update_qty);
            if ($qty_result) {
                $message = "Quantity updated";
            }
        }
    }
    else{
        $user_id = "0";
        header('location: home.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Cart</title>

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
    
    <!-- cart section start -->

    <section class="products">
        <h1 class="heding">your cart</h1>
        <div class="box-container">
            <?php
                $select_cart = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                $result_cart = mysqli_query($conn, $select_cart);
                $num_row_cart = mysqli_num_rows($result_cart);
                $grand_total = 0;
                if ($num_row_cart > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($result_cart)) {
                        $grand_total += ($fetch_products['price'] * $fetch_products['quantity']);
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_products['pid']; ?>">
                <button type="submit"  name="delete" onclick="return confirm('Delete this item from cart?');" class="fas fa-trash-can"></button>
                <a href="quick_view.php?pid=<?= $fetch_products['pid']; ?>" class="fas fa-eye"></a>
                <img src="upload_images/<?= $fetch_products['image']; ?>" alt="image" class="image">
                <div class="name"><?= $fetch_products['name']; ?></div>
                <div class="flex">
                    <div class="price">Rs- <span><?= $fetch_products['price']; ?></span>/-</div>
                    <div class="qty-box">
                        <input type="number" name="qty" class="qty" min="1" max="9" value="<?= $fetch_products['quantity']; ?>" onkeypress="if(this.value.length == 1) return false;">
                        <button type="submit" class="fas fa-edit" name="update_qty"></button>
                    </div>
                </div>
                <div class="sub-total">Sub total: RS- <span><?= $fetch_products['price'] * $fetch_products['quantity'] ?></span>/-</div>
            </form>
            <?php
                    }
                }else {
                    echo '<p class="empty">your cart is empty</p>';
                }
            ?>

        
        </div>
        <div class="wishlist-total">
            <div class="grand-total">Grand total : Rs- <span><?= $grand_total ?></span>/-</div>
            <a href="shop.php" class="option-btn">Continue shopping</a>
            <a href="checkout.php" class="btn <?= ($grand_total > 1)? '' : 'disabled'?>">Proceed to checkout</a>
            <a href="cart.php?delete_all" onclick="return confirm('Delete all item from cart?');" class="delete-btn <?= ($grand_total > 1)? '' : 'disabled'?>">Delete All</a>
        </div>
    </section>

    <!-- cart section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
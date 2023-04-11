<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = "0";
    }

    // ------------place order------------
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['order'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', Pin- '.$_POST['pin_code'];
        $total_products = $_POST['total_products'];
        $total_price = $_POST['total_price'];

        $check_cart = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
        $result_cart = mysqli_query($conn, $check_cart);
        $num_row_cart = mysqli_num_rows($result_cart);
        if ($num_row_cart > 0) {
            $select_admin = "SELECT `admin_id` FROM `admins`";
            $result_asmin = mysqli_query($conn, $select_admin);
            while ($fetch_admin = mysqli_fetch_assoc($result_asmin)) {
                $admin_id = $fetch_admin['admin_id'];
                $check_cart_admin = "SELECT * FROM `cart` WHERE `user_id` = '$user_id' AND `admin_id` = '$admin_id'";
                $result_cart_admin = mysqli_query($conn, $check_cart_admin);
                $num_row_admin = mysqli_num_rows($result_cart_admin);

                // $num_row_cart = mysqli_num_rows($result_cart);
                $grand_total_admin = 0;
                $cart_items_admin = array('');
                if ($num_row_admin > 0) {
                    while ($fetch_products_admin = mysqli_fetch_assoc($result_cart_admin)) {
                        $grand_total_admin += ($fetch_products_admin['price'] * $fetch_products_admin['quantity']);
                        $cart_items_admin[] = $fetch_products_admin['name'] .' ('. $fetch_products_admin['quantity'] .')- ';
                        $total_products_admin = implode($cart_items_admin);
                    }
                
                    $insert_order = "INSERT INTO `orders` (`admin_id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`) VALUES ('$admin_id', '$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products_admin', '$grand_total_admin')";
                    $result_order = mysqli_query($conn, $insert_order); 
                }
            }
            
            if ($result_order) {
                $message = "Order placed successfully"; 
            }



            $delete_cart = "DELETE FROM `cart` WHERE user_id = '$user_id'";
            $delete_cart_result = mysqli_query($conn, $delete_cart);
        }
        else{
            $message[] = 'your cart is empty!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Checkout</title>

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
    
    <!-- checkout section start -->

    <section class="checkout">
    <h1 class="heding">your orders</h1>
        <div class="display-orders">
            <?php
                $cart_items[] = '';
                $select_cart = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                $result_cart = mysqli_query($conn, $select_cart);
                $num_row_cart = mysqli_num_rows($result_cart);
                $grand_total = 0;
                if ($num_row_cart > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($result_cart)) {
                        $grand_total += ($fetch_products['price'] * $fetch_products['quantity']);
                        $cart_items[] = $fetch_products['name'] .' ('. $fetch_products['quantity'] .')- ';
                        $total_products = implode($cart_items);
            ?>
            <p> <?= $fetch_products['name']; ?> : <span>Rs-<?= $fetch_products['price']; ?>/- x <?= $fetch_products['quantity']; ?></span></p>
            <?php
                    }
                }else {
                    echo '<p class="empty">your cart is empty</p>';
                }
            ?>

        </div>

        <p class="grand-total">Grand total : <span>Rs- <?= $grand_total ?>/-</span></p>

        <form action="" method="post">
            <h1 class="heding">Place order</h1>
            <input type="hidden" name="total_products" value="<?= $total_products ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total ?>">
            <div class="flex">
                <div class="inputBox">
                    <span>Your name :</span>
                    <input type="text" maxlength="30" placeholder="Enter your name" required class="box" name="name">
                </div>
                <div class="inputBox">
                    <span>Your number :</span>
                    <input type="number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" placeholder="Enter your number" required class="box" name="number">
                </div>
                <div class="inputBox">
                    <span>Your email :</span>
                    <input type="email" maxlength="50" placeholder="Enter your email" required class="box" name="email">
                </div>
                <div class="inputBox">
                    <span>payment method :</span>
                    <select name="method" class="box">
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="debit card">debit card</option>
                        <option value="paytm">paytm</option>
                        <option value="qr">QR</option>
                        <option value="upi">UPI - Gpay Phonepay etc.</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Adress line 01 :</span>
                    <input type="text" maxlength="50" placeholder="e.g. flat no." required class="box" name="flat">
                </div>
                <div class="inputBox">
                    <span>Adress line 02 :</span>
                    <input type="text" maxlength="50" placeholder="e.g. street name" required class="box" name="street">
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" maxlength="50" placeholder="e.g. Howrah" required class="box" name="city">
                </div>
                <div class="inputBox">
                    <span>Pin code :</span>
                    <input type="number" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" placeholder="e.g. 123456" required class="box" name="pin_code">
                </div>
            </div>
            <input type="submit" value="place order" name="order" class="btn <?= ($grand_total > 1)? '' : 'disabled'?>">">
        </form>
    </section>

    <!-- checkout section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
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
    <title>E-Shop | Orders</title>

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
    
    <!-- order section start -->

    <section class="show-orders">
        <h1 class="heding">Your orders</h1>
        <div class="box-container">
            <?php
                $show_orders = "SELECT * FROM `orders` WHERE `user_id` = '$user_id' ORDER BY `payment_status` DESC";
                $result_orders = mysqli_query($conn, $show_orders);
                $num_row_orders = mysqli_num_rows($result_orders);
                if ($num_row_orders > 0) {
                    while ($fetch_orders = mysqli_fetch_assoc($result_orders)) {
            ?>
            <div class="box">
                <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
                <p>Your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
                <p>Total price : <span>Rs- <?= $fetch_orders['total_price']; ?>/-</span></p>
                <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>
                <p>Payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red';}else{ echo 'green';}?>;"><?= $fetch_orders['payment_status']; ?></span></p>
            </div>
            <?php            
                    }
                }
                else{
                    echo '<p class="empty">No order placed yet!</p>';
                }
            ?>
        </div>
    </section>

    <!-- order section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
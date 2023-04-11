<?php
    session_start();
    $a_id = $_SESSION['a_id'];
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        include '../components/_db-connect.php';

    }
    else{
        header("location: admin_login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Admin dashboard section start -->

    <section class="dashboard">
        <h1 class="heding">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <h3>Welcome!</h3>
                <p><?php echo $profile['name']; ?></p>
                <a href="update_profile.php" class="btn">Update Profile</a>
            </div>

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = "SELECT * FROM `orders` WHERE `payment_status` = 'pending' AND admin_id = $a_id";
                $pendings_result = mysqli_query($conn, $select_pendings);
                while ($fetch_pendings = mysqli_fetch_assoc($pendings_result)) {
                    $total_pendings += $fetch_pendings['total_price'];
                }
            ?>
                <h3><span><i class="fas fa-rupee-sign"></i>: </span><?php echo $total_pendings; ?><span> /-</span></h3>
                <p>Total Pendings</p>
                <a href="placed_orders.php" class="btn">See Ordrs</a>
            </div>

            <div class="box">
                <?php
                $total_completes = 0;
                $select_completes = "SELECT * FROM `orders` WHERE `payment_status` = 'completed' AND admin_id = $a_id";
                $completes_result = mysqli_query($conn, $select_completes);
                while ($fetch_completes = mysqli_fetch_assoc($completes_result)) {
                    $total_completes += $fetch_completes['total_price'];
                }
            ?>
                <h3><span><i class="fas fa-rupee-sign"></i>: </span><?php echo $total_completes; ?><span> /-</span></h3>
                <p>Total Completes</p>
                <a href="placed_orders.php" class="btn">See Ordrs</a>
            </div>

            <div class="box">
                <?php
                    $select_orders = "SELECT * FROM `orders` WHERE admin_id = $a_id";
                    $orders_result = mysqli_query($conn, $select_orders);
                    $number_of_orders = mysqli_num_rows($orders_result);
                ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Total Orders</p>
                <a href="placed_orders.php" class="btn">See Ordrs</a>
            </div>

            <div class="box">
                <?php
                    $select_products = "SELECT * FROM `products` WHERE admin_id = $a_id";
                    $products_result = mysqli_query($conn, $select_products);
                    $number_of_products = mysqli_num_rows($products_result);
                ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>Products Added</p>
                <a href="products.php" class="btn">See Products</a>
            </div>

            <div class="box">
                <?php
                    $select_users = "SELECT * FROM `users`";
                    $users_result = mysqli_query($conn, $select_users);
                    $number_of_users = mysqli_num_rows($users_result);
                ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>Users Accounts</p>
                <a href="users_accounts.php" class="btn">See Users</a>
            </div>

            <div class="box">
                <?php
                    $select_admins = "SELECT * FROM `admins`";
                    $admins_result = mysqli_query($conn, $select_admins);
                    $number_of_admins = mysqli_num_rows($admins_result);
                ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>Admins Accounts</p>
                <a href="admins_accounts.php" class="btn">See Admins</a>
            </div>

            <div class="box">
                <?php
                    $select_messages = "SELECT * FROM `messages`";
                    $messages_result = mysqli_query($conn, $select_messages);
                    $number_of_messages = mysqli_num_rows($messages_result);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>Total Messages</p>
                <a href="messages.php" class="btn">See Messages</a>
            </div>

        </div>

    </section>

    <!-- Admin dashboard section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
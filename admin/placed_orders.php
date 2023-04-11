<?php
    session_start();
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        include '../components/_db-connect.php';

    }
    else{
        header("location: admin_login.php");
        exit();
    }


    // -------------Update payment status-------------
    if (isset($_POST['update_payment'])) {
        $order_id = $_POST['order_id'];
        $a_id = $_SESSION['a_id'];
        $payment_status = $_POST['payment_status'];

        $update_sql = "UPDATE `orders` SET `payment_status` = '$payment_status' WHERE admin_id = $a_id AND id = $order_id";
        $result = mysqli_query($conn, $update_sql);
        if ($result) {
            $message = "Payment status updated!";
        }
    }


    // -------------Delete payment status-------------
    if (isset($_GET['delete'])) {
        $order_id = $_GET['delete'];
        $a_id = $_SESSION['a_id'];

        $delete_sql = "DELETE FROM `orders` WHERE `id` = $order_id AND admin_id = $a_id";
        $delete_result = mysqli_query($conn, $delete_sql);
        if ($delete_result) {
            $message = "Order deleted!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Placed Orders</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link using PHP -->
    <!-- <style>
    <?php include "../css/admin_style.css"?>
    </style> -->

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Placed orders section start -->

    <section class="placed-orders">
        <h1 class="heding">Placed Orders</h1>
        <div class="box-container">

            <?php
                $a_id = $_SESSION['a_id'];
        
                $order_sql = "SELECT * FROM `orders` WHERE admin_id = $a_id ORDER BY `payment_status` DESC";
                $order_result = mysqli_query($conn, $order_sql);
                $num_row = mysqli_num_rows($order_result);
                if ($num_row > 0) {
                    while ($row = mysqli_fetch_assoc($order_result)){
            ?>

            <div class="box">
                <div>
                    <p>User id: <span><?= $row['user_id']?></span>  |  Order id: <span><?= $row['id']?></span></p>
                    <p>Placed on: <span><?= $row['placed_on']?></span></p>
                    <p>Name: <span><?= $row['name']?></span></p>
                    <p>Email: <span><?= $row['email']?></span></p>
                    <p>Number: <span><?= $row['number']?></span></p>
                    <p>Address: <span><?= $row['address']?></span></p>
                    <p>Payment method: <span><?= $row['method']?></span></p>
                    <p>Total products: <span><?= $row['total_products']?></span></p>
                    <p>Total price: <span>Rs: <?= $row['total_price']?>/-</span></p>
                    <p>Payment status: <span style="color:<?php if($row['payment_status'] == 'pending'){ echo 'red';}else{ echo 'green';}?>;"><?= $row['payment_status']?></span></p>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?= $row['id']?>">
                    <select name="payment_status" class="drop-down">
                        <option value="" selected disabled><?= $row['payment_status']?></option>
                        <option value="completed">Completed</option>
                    </select>
                    <div class="flex-btn">
                        <input type="submit" value="update" class="btn" name="update_payment" onclick="return confirm(`Do you want to complete this products payments ?`)">
                        <a href="placed_orders.php?delete=<?= $row['id']?>" class="delete-btn"
                            onclick="return confirm(`Do you want to Delete this order ?`)">Delete</a>
                    </div>
                </form>
            </div>

            <?php
                    }
                }
                else {
                    echo '<p class="empty">No order placed yet!</p>';
                }
            ?>

        </div>

    </section>

    <!-- Placed orders section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
<?php
    session_start();
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        include '../components/_db-connect.php';

    }
    else{
        header("location: admin_login.php");
        exit();
    }

    // -------------Delete admin account-------------
    if (isset($_GET['delete'])) {
        $a_id = $_SESSION['a_id'];

        $delete_sql = "DELETE FROM `admins` WHERE admin_id = $a_id";
        $delete_result = mysqli_query($conn, $delete_sql);
        if ($delete_result) {
            $message = "account deleted!";
            header("location: ../components/_admin_logout.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Accounts</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <!-- <link rel="stylesheet" href="../css/admin_style.css"> -->

    <!-- coustome css link using PHP -->
    <style>
    <?php include "../css/admin_style.css" ?>
    </style>

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Admins account section start -->

    <section class="admin-accounts">
        <h1 class="heding">admin accounts</h1>
        <div class="box-container">
            <div class="box">
                <p>Register new admin</p>
                <a href="admin_register.php" class="option-btn">Register</a>
            </div>

            <?php
                $a_id = $_SESSION['a_id'];
            
                $admin_sql = "SELECT * FROM `admins` WHERE admin_id = $a_id";
                $admin_result = mysqli_query($conn, $admin_sql);
                $num_row = mysqli_num_rows($admin_result);
                if ($num_row > 0) {
                    while ($row = mysqli_fetch_assoc($admin_result)){
            ?>

            <div class="box">
                <div>
                    <p>Admin id: <span><?= $row['admin_id']?></span></p>
                    <p>Username: <span><?= $row['name']?></span></p>
                </div>
                <div class="flex-btn">
                
                <?php
                    if ($row['admin_id'] == $a_id) {
                        echo '<a href="update_profile.php" class="option-btn">Update</a>
                        <a href="admins_accounts.php?delete='.$a_id.'" class="delete-btn" onclick="return confirm(`Do you want to Delete this account ?`)">Delete</a>
                        ';
                    }
                ?>
                </div>
            </div>

            <?php
                    }
                }
                else {
                    echo '<p class="empty">This account not avalable.</p>';
                }
            ?>
        </div>
         
        <h1 class="heding">all admins</h1>
        <div class="box-container">
            <?php
            
                $admin_all_sql = "SELECT * FROM `admins`";
                $admin_all_result = mysqli_query($conn, $admin_all_sql);
                $num_row = mysqli_num_rows($admin_all_result);
                if ($num_row > 0) {
                    while ($admin_row = mysqli_fetch_assoc($admin_all_result)){
            ?>

            <div class="box">
                <p>Admin id: <span><?= $admin_row['admin_id']?></span></p>
                <p>Username: <span><?= $admin_row['name']?></span></p>
                <p>Email: <span><?= $admin_row['email']?></span></p>
            </div>

            <?php
                    }
                }
                else {
                    echo '<p class="empty">No accounts avalable yet!</p>';
                }
            ?>

        </div>
    </section>

    <!-- Admins accounts section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
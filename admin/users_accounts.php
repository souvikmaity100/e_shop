<?php
    session_start();
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
    <title>Admin - Users Accounts</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Users account section start -->

    <section class="admin-accounts">
        <h1 class="heding">ALL User accounts</h1>
        <div class="box-container">

            <?php
            
                $user_sql = "SELECT * FROM `users`";
                $user_result = mysqli_query($conn, $user_sql);
                $num_row = mysqli_num_rows($user_result);
                if ($num_row > 0) {
                    while ($row = mysqli_fetch_assoc($user_result)){
            ?>

            <div class="box">
                <div>
                    <p>User id: <span><?= $row['user_id']?></span></p>
                    <p>User name: <span><?= $row['name']?></span></p>
                    <p>Email: <span><?= $row['email']?></span></p>
                </div>
            </div>

            <?php
                    }
                }
                else {
                    echo '<p class="empty">No user account avalable yet!</p>';
                }
            ?>
        </div>
         
    </section>

    <!-- Users accounts section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
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
    <title>Admin - Messages</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link using PHP -->
    <!-- <style>
    <?php include "../css/admin_style.css" ?>
    </style> -->

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>
    <?php include '../components/_timeDiff.php'; ?>

    <!-- Messages section start -->
 
    <section class="messages">
        <h1 class="heding">messages</h1>
        <div class="box-container">
            <?php
                $message_sql = "SELECT * FROM `messages` ORDER BY `time` DESC LIMIT 30";
                $message_result = mysqli_query($conn, $message_sql);
                $num_row = mysqli_num_rows($message_result);
                if ($num_row > 0) {
                    while ($message_row = mysqli_fetch_assoc($message_result)){
            ?>

            <div class="box">
                <div>
                    <p>User name: <span><?= $message_row['name']?></span></p>
                    <p>Number: <span><?= $message_row['number']?></span></p>
                    <p>Email: <span><?= $message_row['email']?></span></p>
                    <p>Message: <span><?= $message_row['message']?></span></p>
                </div>
                <p class="time">Time: <span><?= timediff($message_row['time'])?></span></p>
            </div>

            <?php
                    }
                }
                else {
                    echo '<p class="empty">No message avalable yet!</p>';
                }
            ?>

        </div>
    </section>

    <!-- Messages section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
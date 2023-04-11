<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];

        if (($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['u_submit'])) {
    
            $u_new_name = $_POST['u_new_name'];
            $u_new_email = $_POST['u_new_email'];
            $u_old_pass = $_POST['u_old_pass'];
            $u_new_pass = $_POST['u_new_pass'];
            $u_new_cpass = $_POST['u_new_cpass'];

    
            $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows == 1) {
                $row = mysqli_fetch_assoc($result);
                if ($u_old_pass == '') {
                    $update_name = "UPDATE `users` SET `name` = '$u_new_name',`email` = '$u_new_email' WHERE `user_id` = '$user_id'";
                    $Update_result = mysqli_query($conn, $update_name);
                    if ($Update_result) {
                        $message = "Name and email updated succesfully";
                    }
                }
                else{
                    if (password_verify($u_old_pass, $row['password'])) {
                        if ($u_new_pass != $u_new_cpass) {
                        $message = "Confirm password dosn't match";
                        }
                        else{
                            $hash = password_hash($u_new_pass, PASSWORD_DEFAULT);
                            $sql2 = "UPDATE `users` SET `name` = '$u_new_name',`email` = '$u_new_email', `password` = '$hash' WHERE `user_id` = '$user_id'";
                            $result = mysqli_query($conn, $sql2);
                            if ($result) {
                                $message = "Account updated sucessfully";
                            }
                        }
                    }
                    else {
                        $message = "Please enter your old password correctly";
                    }
                }
            }
            else {
                $message = "Technical issue! Contact with team.";
            }
        }
    }
    else{
        $user_id = "0";
        header('location: home.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Update Profile</title>

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
    
    
    <!-- Admin update profile section start -->

    <section class="form-container">
        <form action="" method="post">

            <?php
                $user_sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
                $user_result = mysqli_query($conn, $user_sql);
                $numRows = mysqli_num_rows($user_result);
                if ($numRows == 1) {
                    $row = mysqli_fetch_assoc($user_result);
                }
                else{
                    $message = "Technical Error!";
                }
            ?>

            <h3>Update Profile</h3>
            <input type="text" name="u_new_name" class="box" placeholder="Enter your name" required maxlength="20" value="<?= $row['name'] ?>">
            <input type="email" name="u_new_email" class="box" placeholder="Enter your email" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $row['email'] ?>">
            <input type="password" name="u_old_pass" class="box" placeholder="Enter your old password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="u_new_pass" class="box" placeholder="Enter your new password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="u_new_cpass" class="box" placeholder="Confirm your new password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Update now" name="u_submit" class="btn">
        </form>
    </section>

    <!-- Admin update profile section end -->
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
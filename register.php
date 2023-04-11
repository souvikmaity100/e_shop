<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = "0";
    }

    if (($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['register'])) {

        $u_name = $_POST['name'];
        $u_email = $_POST['email'];
        $u_pass = $_POST['password'];
        $u_cpass = $_POST['c_password'];

        $sql = "SELECT * FROM `users` WHERE `email` = '$u_email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows > 0) {
            $message = "You already have an account in this email";
        }
        else {
            if($u_pass != $u_cpass){
                $message = "Confirm password dosn't match";
            }
            else {
                $hash = password_hash($u_pass, PASSWORD_DEFAULT);
                $sql2 = "INSERT INTO `users` (`name`, `email`, `password`, `time`) VALUES ('$u_name', '$u_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql2);
                if ($result) {
                    $message = "You register successfully! Now you can login.";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Register</title>

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
    
    <!-- Usr register section start -->

    <section class="form-container">
        <form action="" method="POST">
            <h3>Register Now</h3>
            <input type="text" name="name" placeholder="Enter your name" required maxlength="30" class="box">
            <input type="email" name="email" placeholder="Enter your email" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box">
            <input type="password" name="password" placeholder="Enter your password" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box">
            <input type="password" name="c_password" placeholder="Confirm your password" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box">
            <input type="submit" value="Register" name="register" class="btn">

            <p>Already have any account?</p>
            <a href="login.php" class="option-btn">Login</a>
        </form>
    </section>

    <!-- Usr register section end -->
    
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
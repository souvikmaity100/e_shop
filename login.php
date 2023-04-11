<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = "0";
    }

    if (($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['submit'])) {

        $u_email = $_POST['email'];
        $u_pass = $_POST['password'];

        $user_sql = "SELECT * FROM `users` WHERE `email` = '$u_email'";
        $user_result = mysqli_query($conn, $user_sql);
        $numRows = mysqli_num_rows($user_result);
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($user_result);
            if (password_verify($u_pass, $row['password'])) {
                session_start();
                $_SESSION['user_loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                header("location: home.php");
                exit();
            }
            else {
                $message = "Please enter correct password";
            }
        }
        else {
            $message = "You don't have any account in this email";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop | Login</title>

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
    
    <!-- Usr login section start -->

    <section class="form-container">
        <form action="" method="POST">
            <h3>Login Now</h3>
            <input type="email" name="email" placeholder="Enter your email" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box">
            <input type="password" name="password" placeholder="Enter your password" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" class="box">
            <input type="submit" value="Login" name="submit" class="btn">

            <p>Don't have any account?</p>
            <a href="register.php" class="option-btn">create account</a>
        </form>
    </section>

    <!-- Usr login section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
<?php
    include '../components/_db-connect.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $a_name = $_POST['a_name'];
        $a_pass = $_POST['a_pass'];

        $sql = "SELECT * FROM `admins` WHERE `name` = '$a_name'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($a_pass, $row['password'])) {
                session_start();
                $_SESSION['a_loggedin'] = true;
                $_SESSION['a_name'] = $a_name;
                $_SESSION['a_id'] = $row['admin_id'];
                header("location: dashbord.php");
                exit();
            }
            else {
                $message = "Please enter correct password";
            }
        }
        else {
            $message = "Yoo don't have any account in this username";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">
    
    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>
<body>
    
    <?php include '../components/_admin_header.php'; ?>

    
    <!-- Admin login form section start -->
    <section class="form-container">
        <form action="" method="post">
            <h3>Admin Login</h3>
            <p>Don't share <span>Username</span> & <span>Password</span> with anyone</p>
            <input type="text" name="a_name" class="box" placeholder="Enter your username" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="a_pass" class="box" placeholder="Enter your password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Login now" name="a_submit" class="btn">
        </form>
    </section>
    <!-- Admin login form section end -->


    
    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>
    
</body>
</html>
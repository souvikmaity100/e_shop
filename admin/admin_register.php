<?php

    include '../components/_db-connect.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $a_name = $_POST['a_name'];
        $a_email = $_POST['a_email'];
        $a_pass = $_POST['a_pass'];
        $a_cpass = $_POST['a_cpass'];

        $sql = "SELECT * FROM `admins` WHERE `name` = '$a_name'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows > 0) {
            $message = "Username already exist! Please try different username.";
        }
        else {
            if($a_pass != $a_cpass){
                $message = "Confirm password dosn't match";
            }
            else {
                $hash = password_hash($a_pass, PASSWORD_DEFAULT);
                $sql2 = "INSERT INTO `admins` (`name`, `email`, `password`, `time`) VALUES ('$a_name', '$a_email', '$hash', current_timestamp())";
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
    <title>Admin - Register</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>
    
    <?php include '../components/_admin_header.php'; ?>

    <!-- Admin register section start -->

    <section class="form-container">
        <form action="" method="post">
            <h3>Admin Register</h3>
            <input type="text" name="a_name" class="box" placeholder="Enter your username" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="email" name="a_email" class="box" placeholder="Enter your email id" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="a_pass" class="box" placeholder="Enter your password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="a_cpass" class="box" placeholder="Confirm your password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Register now" name="a_submit" class="btn">
        </form>
    </section>

    <!-- Admin register section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
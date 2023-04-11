<?php
    session_start();
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        include '../components/_db-connect.php';
        if ($_SERVER['REQUEST_METHOD']=='POST') {
    
            $a_new_name = $_POST['a_new_name'];
            $a_old_pass = $_POST['a_old_pass'];
            $a_new_pass = $_POST['a_new_pass'];
            $a_new_cpass = $_POST['a_new_cpass'];

            $a_id = $_SESSION['a_id'];
    
            $sql = "SELECT * FROM `admins` WHERE `admin_id` = '$a_id'";
            $result = mysqli_query($conn, $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($a_old_pass, $row['password'])) {
                    if ($a_new_pass != $a_new_cpass) {
                        $message = "Confirm password dosn't match";
                    }
                    else{
                        $hash = password_hash($a_new_pass, PASSWORD_DEFAULT);
                        $sql2 = "UPDATE `admins` SET `name` = '$a_new_name', `password` = '$hash' WHERE `admin_id` = '$a_id'";
                        $result = mysqli_query($conn, $sql2);
                        if ($result) {
                            $_SESSION['a_name'] = $a_new_name;
                            $message = "Account updated sucessfully";
                            // exit();
                        }
                    }
                }
                else {
                    $message = "Please enter your old password correctly";
                }
            }
            else {
                $message = "Technical issue! Contact with team.";
            }
        }

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
    <title>Admin - Update Profile</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Admin update profile section start -->

    <section class="form-container">
        <form action="" method="post">
            <h3>Update Profile</h3>
            <input type="text" name="a_new_name" class="box" placeholder="Enter your username" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php echo $_SESSION['a_name']; ?>">
            <input type="password" name="a_old_pass" class="box" placeholder="Enter your old password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="a_new_pass" class="box" placeholder="Enter your new password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="a_new_cpass" class="box" placeholder="Confirm your new password" required maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Update now" name="a_submit" class="btn">
        </form>
    </section>

    <!-- Admin update profile section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
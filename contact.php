<?php
    session_start();
    include 'components/_db-connect.php';
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id = "0";
    }

    // ------------Send messages------------
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['send'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $message = $_POST['msg'];

        $select_message = "SELECT * FROM `messages` WHERE `name`='$name' AND `email`='$email' AND `number`='$number' AND `message`='$message'";
        $result_message = mysqli_query($conn, $select_message);
        $numRows = mysqli_num_rows($result_message);
        if($numRows > 0){
            $message = "Message sent already!";
        }
        else{
            $send_message = "INSERT INTO `messages` (`user_id`, `name`, `email`, `number`, `message`, `time`) VALUES ('$user_id', '$name', '$email', '$number', '$message', current_timestamp());";
            $result_send_message = mysqli_query($conn, $send_message);
            if ($result_send_message) {
                $message = "message send succesfully";
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
    <title>E-Shop | Contact</title>

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
    
    <!-- contact section start -->

    <section class="form-container">
        <h1 class="heding">Contact us</h1>
        <form action="" method="post" class="box">
            <input type="text" name="name" required placeholder="Enter your name" maxlength="30" class="box">
            <input type="number" name="number" required placeholder="Enter your number" max="9999999999" min="0" class="box" onkeypress="if(this.value.length == 10) return false ">
            <input type="email" name="email" required placeholder="Enter your email" maxlength="50" class="box">
            <textarea name="msg" placeholder="enter your message" required class="box" cols="30" rows="10"></textarea>
            <input type="submit" value="Send message" class="btn" name="send">
        </form>
    </section>

    <!-- contact section end -->
    
    
    
    
    <?php include 'components/_footer.php'; ?>
    
    <!-- coustome js link -->
    <!-- <script src="js/script.js"></script> -->

    <script>
        <?php include 'js/script.js'; ?>
    </script>

</body>
</html>
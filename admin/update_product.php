<?php
    session_start();
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        include '../components/_db-connect.php';

    }
    else{
        header("location: admin_login.php");
        exit();
    }


    // -------------Update Product-------------
    if (isset($_POST['update'])) {
        $a_id = $_SESSION['a_id'];
        $p_id = $_POST['p_id'];
        $p_name = $_POST['p_name'];
        $p_price = $_POST['p_price'];
        $details = $_POST['details'];

        $update_sql = "UPDATE `products` SET `name` = '$p_name', `price` = '$p_price', `details` = '$details' WHERE admin_id = $a_id AND id = $p_id";
        $result = mysqli_query($conn, $update_sql);

        $update_cart_sql = "UPDATE `cart` SET `name` = '$p_name', `price` = '$p_price' WHERE  pid = $p_id";
        $result_cart = mysqli_query($conn, $update_cart_sql);

        $update_wishlist_sql = "UPDATE `wishlist` SET `name` = '$p_name', `price` = '$p_price' WHERE  pid = $p_id";
        $result_wishlist = mysqli_query($conn, $update_wishlist_sql);

        if ($result && $result_cart && $result_wishlist) {
            $message = "Product updated!";
        }

        //----------- Update img 01 ----------------
        $old_img_01 = $_POST['old_img_01'];
        $img_01_name = $_FILES['img_01']['name'];
        $img_01_size = $_FILES['img_01']['size'];
        $img_01_tmp_name = $_FILES['img_01']['tmp_name'];

        if (!empty($img_01_name)) {
            if ($img_01_size > 1500000){
                $message = "sorry! your img file is to large";
            }
            else{
                $img_ex_01 = pathinfo($img_01_name, PATHINFO_EXTENSION);
                $img_ex_lc_01 = strtolower($img_ex_01);
                $allowd_exs_01 = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc_01, $allowd_exs_01)){
                    $new_img_01_name = uniqid("IMG-", true).'.'.$img_ex_lc_01;
                    $img_01_upload_path = '../upload_images/'.$new_img_01_name;
                    move_uploaded_file($img_01_tmp_name, $img_01_upload_path);

                    $img_01_sql = "UPDATE `products` SET `image_01` = '$new_img_01_name' WHERE admin_id = $a_id AND id = $p_id";
                    $img_01_result = mysqli_query($conn, $img_01_sql);

                    $img_01_cart_sql = "UPDATE `cart` SET `image` = '$new_img_01_name' WHERE  pid = $p_id";
                    $img_01_cart_result = mysqli_query($conn, $img_01_cart_sql);

                    $img_01_wishlist_sql = "UPDATE `wishlist` SET `image` = '$new_img_01_name' WHERE  pid = $p_id";
                    $img_01_wishlist_result = mysqli_query($conn, $img_01_wishlist_sql);

                    if ($img_01_result && $img_01_cart_result && $img_01_wishlist_result) {
                        unlink('../upload_images/'. $old_img_01);
                        $message = "Image updated"; 
                    }

                }
                else {
                    $message = "You can't upload this type of file";
                }
            }
        }
        
        //----------- Update img 02 ----------------
        $old_img_02 = $_POST['old_img_02'];
        $img_02_name = $_FILES['img_02']['name'];
        $img_02_size = $_FILES['img_02']['size'];
        $img_02_tmp_name = $_FILES['img_02']['tmp_name'];

        if (!empty($img_02_name)) {
            if ($img_02_size > 1500000){
                $message = "sorry! your img file is to large";
            }
            else{
                $img_ex_02 = pathinfo($img_02_name, PATHINFO_EXTENSION);
                $img_ex_lc_02 = strtolower($img_ex_02);
                $allowd_exs_02 = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc_02, $allowd_exs_02)){
                    $new_img_02_name = uniqid("IMG-", true).'.'.$img_ex_lc_02;
                    $img_02_upload_path = '../upload_images/'.$new_img_02_name;
                    move_uploaded_file($img_02_tmp_name, $img_02_upload_path);

                    $img_02_sql = "UPDATE `products` SET `image_02` = '$new_img_02_name' WHERE admin_id = $a_id AND id = $p_id";
                    $img_02_result = mysqli_query($conn, $img_02_sql);
                    if ($img_02_result) {
                        unlink('../upload_images/'. $old_img_02);
                        $message = "Image updated"; 
                    }

                }
                else {
                    $message = "You can't upload this type of file";
                }
            }
        }
        
        //----------- Update img 03 ----------------
        $old_img_03 = $_POST['old_img_03'];
        $img_03_name = $_FILES['img_03']['name'];
        $img_03_size = $_FILES['img_03']['size'];
        $img_03_tmp_name = $_FILES['img_03']['tmp_name'];

        if (!empty($img_03_name)) {
            if ($img_03_size > 1500000){
                $message = "sorry! your img file is to large";
            }
            else{
                $img_ex_03 = pathinfo($img_03_name, PATHINFO_EXTENSION);
                $img_ex_lc_03 = strtolower($img_ex_03);
                $allowd_exs_03 = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc_03, $allowd_exs_03)){
                    $new_img_03_name = uniqid("IMG-", true).'.'.$img_ex_lc_03;
                    $img_03_upload_path = '../upload_images/'.$new_img_03_name;
                    move_uploaded_file($img_03_tmp_name, $img_03_upload_path);

                    $img_03_sql = "UPDATE `products` SET `image_03` = '$new_img_03_name' WHERE admin_id = $a_id AND id = $p_id";
                    $img_03_result = mysqli_query($conn, $img_03_sql);
                    if ($img_03_result) {
                        unlink('../upload_images/'. $old_img_03);
                        $message = "Image updated"; 
                    }

                }
                else {
                    $message = "You can't upload this type of file";
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
    <title>Admin - Update Product</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <!-- <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>"> -->

    <!-- coustome css link using PHP -->
    <!-- <style>
        <?php include "../css/admin_style.css" ?>
    </style> -->

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Update products section start -->

    <section class="update-product">
        <h1 class="heding">Update product</h1>
        <?php
            if (isset($_GET['update'])) {
                $p_id = $_GET['update'];
                $a_id = $_SESSION['a_id'];
                $sql = "SELECT * FROM `products` WHERE admin_id = $a_id AND id = $p_id";
                $result = mysqli_query($conn, $sql);
                $num_row = mysqli_num_rows($result);
                if ($num_row == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
            
        ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="p_id" value="<?= $p_id ?>" >
                            <input type="hidden" name="old_img_01" value="<?= $row['image_01']; ?>" >
                            <input type="hidden" name="old_img_02" value="<?= $row['image_02']; ?>" >
                            <input type="hidden" name="old_img_03" value="<?= $row['image_03']; ?>" >
                            <div class="image-container">
                                <div class="main-image">
                                    <img src="../upload_images/<?= $row['image_01']; ?>" alt="imahe 01">
                                </div>
                                <div class="sub-images">
                                    <img src="../upload_images/<?= $row['image_01']; ?>" alt="imahe 01">
                                    <img src="../upload_images/<?= $row['image_02']; ?>" alt="imahe 02">
                                    <img src="../upload_images/<?= $row['image_03']; ?>" alt="imahe 03">
                                </div>
                            </div>
                            <span>Update product name: </span>
                            <input type="text" required placeholder="Enter product name" name="p_name" maxlength="100" class="box" value="<?= $row['name']; ?>">
                            <span>Update product price: </span>
                            <input type="number" min="0" max="9999999" required placeholder="Enter product price" name="p_price" onkeypress="if(this.value.length == 7) return false" class="box" value="<?= $row['price']; ?>">
                            <span>Update product details: </span>
                            <textarea required name="details" class="box" placeholder="Enter product details" maxlength="1000" cols="30" rows="10"><?= $row['details']; ?></textarea>
                            <span>Update image 01: </span>
                            <input type="file" name="img_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp ">
                            <span>Update image 02: </span>
                            <input type="file" name="img_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp ">
                            <span>Update image 03: </span>
                            <input type="file" name="img_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp ">
                            <div class="flex-btn">
                                <input type="submit" value="Update" class="btn" name="update">
                                <a href="products.php" class="option-btn">Go Back</a>
                            </div>
                        </form>

        <?php
                    }
                }
                else {
                    echo '<p class="empty">This product is not avalable!</p>';
                }
            }
            else {
                $message = "Unidentified Error";
                exit();
            }
        ?>
    </section>

    <!-- Update products section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js" ></script>

    <!-- coustome js link using PHP-->
    <!-- <script>
        <?php include "../js/admin_script.js" ?>
    </script> -->

</body>

</html>
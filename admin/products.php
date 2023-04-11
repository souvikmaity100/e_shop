<?php
    session_start();
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        include '../components/_db-connect.php';
        if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_product'])) {
    
            $p_name = $_POST['p_name'];
            $p_price = $_POST['p_price'];
            $details = $_POST['details'];
            
            //----------- img 01 ----------------
            $img_01_name = $_FILES['img_01']['name'];
            $img_01_size = $_FILES['img_01']['size'];
            $img_01_tmp_name = $_FILES['img_01']['tmp_name'];
            
            //----------- img 02 ----------------
            $img_02_name = $_FILES['img_02']['name'];
            $img_02_size = $_FILES['img_02']['size'];
            $img_02_tmp_name = $_FILES['img_02']['tmp_name'];
            
            //----------- img 03 ----------------
            $img_03_name = $_FILES['img_03']['name'];
            $img_03_size = $_FILES['img_03']['size'];
            $img_03_tmp_name = $_FILES['img_03']['tmp_name'];

            if ($img_01_size > 1500000 || $img_02_size > 1500000 || $img_03_size > 1500000) {
                $message = "sorry! your img file is to large";
            }
            else {
                $img_ex_01 = pathinfo($img_01_name, PATHINFO_EXTENSION);
                $img_ex_lc_01 = strtolower($img_ex_01);
                $allowd_exs_01 = array("jpg", "jpeg", "png", "webp");

                $img_ex_02 = pathinfo($img_02_name, PATHINFO_EXTENSION);
                $img_ex_lc_02 = strtolower($img_ex_02);
                $allowd_exs_02 = array("jpg", "jpeg", "png", "webp");

                $img_ex_03 = pathinfo($img_03_name, PATHINFO_EXTENSION);
                $img_ex_lc_03 = strtolower($img_ex_03);
                $allowd_exs_03 = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc_01, $allowd_exs_01) && in_array($img_ex_lc_02, $allowd_exs_02) && in_array($img_ex_lc_03, $allowd_exs_03)) {
                    
                    $new_img_01_name = uniqid("IMG-", true).'.'.$img_ex_lc_01;
                    $img_01_upload_path = '../upload_images/'.$new_img_01_name;
                    move_uploaded_file($img_01_tmp_name, $img_01_upload_path);

                    $new_img_02_name = uniqid("IMG-", true).'.'.$img_ex_lc_02;
                    $img_02_upload_path = '../upload_images/'.$new_img_02_name;
                    move_uploaded_file($img_02_tmp_name, $img_02_upload_path);

                    $new_img_03_name = uniqid("IMG-", true).'.'.$img_ex_lc_03;
                    $img_03_upload_path = '../upload_images/'.$new_img_03_name;
                    move_uploaded_file($img_03_tmp_name, $img_03_upload_path);

                }
                else {
                    $message = "You can't upload this type of file";
                }
            }   

            $a_id = $_SESSION['a_id'];
            $sql = "INSERT INTO `products` (`admin_id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES ('$a_id', '$p_name', '$details', '$p_price', '$new_img_01_name', '$new_img_02_name', '$new_img_03_name');";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $message = "Product Added sucessfully";
                header("location: products.php");
            }
        }
    }
    else{
        header("location: admin_login.php");
        exit();
    }

    
    // -------------Delete Product-------------
    if (isset($_GET['delete'])) {
        $p_delete_id = $_GET['delete'];
        $a_id = $_SESSION['a_id'];

        $sql3 = "SELECT * FROM `products` WHERE `id` = $p_delete_id AND admin_id = $a_id";
        $result3 = mysqli_query($conn, $sql3);
        $num_row3 = mysqli_num_rows($result3);
        if ($num_row3 == 1) {
            $row = mysqli_fetch_assoc($result3);
            unlink('../upload_images/'. $row['image_01']);
            unlink('../upload_images/'. $row['image_02']);
            unlink('../upload_images/'. $row['image_03']);

            $sql2 = "DELETE FROM `products` WHERE `id` = $p_delete_id AND admin_id = $a_id";
            $result2 = mysqli_query($conn, $sql2);
            $sql4 = "DELETE FROM `cart` WHERE `pid` = $p_delete_id AND admin_id = $a_id";
            mysqli_query($conn, $sql4);
            $sql5 = "DELETE FROM `wishlist` WHERE `pid` = $p_delete_id AND admin_id = $a_id";
            mysqli_query($conn, $sql5);
            if ($result2) {
                $message = "Product Deleted sucessfully";
                header("location: products.php");
            }
        }
        else {
            $message = "Unidentified Error";
            exit();
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Products</title>

    <!-- frontawesom cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- coustome css link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <!-- coustome css link for mobile-->
    <link rel="stylesheet" href="../css/admin_phone.css">

</head>

<body>

    <?php include '../components/_admin_header.php'; ?>

    <!-- Add products section start -->

    <section class="add-products">
        <h1 class="heding">Add Product</h1>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="flex">
                <div class="inputeBox">
                    <span>Product name*</span>
                    <input type="text" required placeholder="Enter product name" name="p_name" maxlength="100" class="box">
                </div>
                <div class="inputeBox">
                    <span>Product price*</span>
                    <input type="number" min="0" max="9999999" required placeholder="Enter product price" name="p_price"
                        onkeypress="if(this.value.length == 7) return false" class="box">
                </div>
                <div class="inputeBox">
                    <span>Product image 01*</span>
                    <input type="file" required name="img_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp ">
                </div>
                <div class="inputeBox">
                    <span>Product image 02*</span>
                    <input type="file" required name="img_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp ">
                </div>
                <div class="inputeBox">
                    <span>Product image 03*</span>
                    <input type="file" required name="img_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp ">
                </div>
                <div class="inputeBox">
                    <span>Product details*</span>
                    <textarea required name="details" class="box" placeholder="Enter product details" maxlength="1000" cols="30" rows="10"></textarea>
                </div>
                <input type="submit" value="Add Product" class="btn" name="add_product">
            </div>

        </form>
    </section>

    <!-- Add products section end -->

    <!-- Show products section start -->
    

    <section class="show-products">
        <h1 class="heding">See Products</h1>
        <div class="box-container">

            <?php
                $a_id = $_SESSION['a_id'];
                $sql = "SELECT * FROM `products` WHERE admin_id = $a_id";
                $result = mysqli_query($conn, $sql);
                $num_row = mysqli_num_rows($result);
                if ($num_row > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $p_id = $row['id'];
                        $p_name = $row['name'];
                        $p_details = $row['details'];
                        $p_price = $row['price'];
                        $p_image_01 = $row['image_01'];
            
                        echo '
                        <div class="box">
                            <div>
                                <img src="../upload_images/'.$p_image_01.'" alt="image_01">
                                <div class="name">'.$p_name.'</div>
                                <div class="price">Rs: '.$p_price.'/-</div>
                                <div class="details">'.$p_details.'</div>
                            </div>
                            <div class="flex-btn">
                                <a href="update_product.php?update='.$p_id.'" class="option-btn">Update</a>
                                <a href="products.php?delete='.$p_id.'" class="delete-btn" onclick="return confirm(`Do you want to Delete this product ?`)">Delete</a>
                            </div>
                        </div>
                        ';
                    }
                }
                else {
                    echo '<p class="empty">No product added yet!</p>';
                }
            ?>
            

        </div>
    </section>

    <!-- Show products section end -->




    <!-- coustome js link -->
    <script src="../js/admin_script.js"></script>

</body>

</html>
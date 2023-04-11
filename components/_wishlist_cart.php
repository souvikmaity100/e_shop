<?php

    if (isset($_POST['add_to_wishlist'])) {
        if($user_id == 0){
            header('location: login.php');
        }
        else{

            $p_id = $_POST['pid'];
            $p_name = $_POST['name'];
            $p_price = $_POST['price'];
            $p_image = $_POST['image'];

            $check_wishlist_number = "SELECT * FROM `wishlist` WHERE pid = $p_id AND user_id = $user_id";
            $result_wishlist_number = mysqli_query($conn, $check_wishlist_number);

            $check_cart_number = "SELECT * FROM `cart` WHERE pid = $p_id AND user_id = $user_id";
            $result_cart_number = mysqli_query($conn, $check_cart_number);

            if (mysqli_num_rows($result_wishlist_number) > 0) {
                $message = "Already added to wishlist!";
            }
            elseif (mysqli_num_rows($result_cart_number) > 0) {
                $message = "Already added to cart!";
            }
            else{
                $insert_wishlist = "INSERT INTO `wishlist` (`user_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id', '$p_id', '$p_name', '$p_price', '$p_image')";
                $result_wishlist = mysqli_query($conn, $insert_wishlist);
                if ($result_wishlist) {
                    $message = "Added to wishlist!";
                }
            }

        }
    }
    if (isset($_POST['add_to_cart'])) {
        if($user_id == 0){
            header('location: login.php');
        }
        else{
            
            $p_id = $_POST['pid'];
            $p_name = $_POST['name'];
            $p_price = $_POST['price'];
            $p_image = $_POST['image'];
            $p_qty = $_POST['qty'];

            $check_cart_number = "SELECT * FROM `cart` WHERE pid = $p_id AND user_id = $user_id";
            $result_cart_number = mysqli_query($conn, $check_cart_number);

            if (mysqli_num_rows($result_cart_number) > 0) {
                $message = "Already added to cart!";
            }
            else{
                $check_wishlist_number = "SELECT * FROM `wishlist` WHERE pid = $p_id AND user_id = $user_id";
                $result_wishlist_number = mysqli_query($conn, $check_wishlist_number);

                if (mysqli_num_rows($result_wishlist_number) > 0) {
                    $delete_wishlist = "DELETE FROM `wishlist` WHERE pid = $p_id AND user_id = $user_id";
                    $delete_result = mysqli_query($conn, $delete_wishlist);
                }

                $select_admin = "SELECT `admin_id` FROM `products` WHERE `id` = '$p_id'";
                $result_admin = mysqli_query($conn, $select_admin);
                $fetch_admin = mysqli_fetch_assoc($result_admin);
                $admin_id = $fetch_admin['admin_id'];

                $insert_cart = "INSERT INTO `cart` (`admin_id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES ('$admin_id', '$user_id', '$p_id', '$p_name', '$p_price', '$p_qty', '$p_image')";
                $result_cart = mysqli_query($conn, $insert_cart);
                if ($result_cart) {
                    $message = "Added to cart!";
                }
            }

        }
    }

?>
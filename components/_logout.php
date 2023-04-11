<?php
    session_start();
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']==true){
        session_unset();
        session_destroy();
        echo "Loggeing you out, please wait...";
        header("location: /e_shop");
        exit();
    }
    else{
        header("location: /e_shop/login.php");
    }
?>
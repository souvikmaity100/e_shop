<?php
    session_start();
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin']==true){
        session_unset();
        session_destroy();
        echo "Loggeing you out, please wait...";
        header("location: /e_shop/admin/admin_login.php");
        exit();
    }
    else{
        header("location: /e_shop/admin/admin_login.php");
    }
?>
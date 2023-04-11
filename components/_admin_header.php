<!-- message and alert section start -->
<?php
if (isset($message)) {
    echo '<div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove()"></i>
        </div>';
   }
?>
<!-- message and alert section end -->

<header class="header">
    <section class="flex">
        <a href="dashbord.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="dashbord.php">Home</a>
            <a href="products.php">Products</a>
            <a href="placed_orders.php">Orders</a>
            <a href="admins_accounts.php">Admins</a>
            <a href="users_accounts.php">Users</a>
            <a href="messages.php">Messages</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
                if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true){
                    $a_name = $_SESSION['a_name'];
                    $sql = "SELECT * FROM `admins` WHERE `name` = '$a_name'";
                    $result = mysqli_query($conn, $sql);
                    $profile = mysqli_fetch_assoc($result);
                }
                else{
                    $profile = array("name"=>"Admin Name");
                }
            ?>
            <p>
                <?php echo $profile['name']; ?>
            </p>
            <a href="update_profile.php" class="btn">Update profile</a>
            <div class="flex-btn">
                <a href="admin_login.php" class="option-btn">Login</a>
                <a href="admin_register.php" class="option-btn">Register</a>
            </div>
            <a href="../components/_admin_logout.php" onclick="return confirm('Do you want to logout from this website ?')" class="delete-btn">Logout</a>
        </div>
    </section>
</header>
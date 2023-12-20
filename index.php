<?php
session_start();
require_once './inc/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <img src="assets/img/image.png" alt="Image" style="display: block; margin: 0 auto;">
    <h1 style="text-align: center;">Car Rental System with Skilled Drivers</h1>
    <title>Car Rental System</title>
    <link rel="stylesheet" type="text/css" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href="../js/bootstrap.js">    
    <link rel="stylesheet" type="text/css" href="../js/bootstrap.min.js">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="admin-s">
                <a href="admin_login.php">Admin Login</a>
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a>
            </div>
            <div class="user-s">
                <?php if( isAdminLoggedIn() ) : ?>
                    <a href="./admin/">Dashboard</a>
                <?php elseif( isUserLoggedIn() ) : ?>
                    <a href="./user/">Dashboard</a>
                <?php else : ?>
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                <?php endif ; ?>
                <a href="contact.php">Contact Us</a>
            </div>
        </nav>
    </header>
    <section class="my-5">
        <h1 class="text-center text-uppercase py-5">Welcome</h1>
    </section>
    <img src="assets/img/ferari.png" alt="Image" style="display: block; margin: 0 auto;">
        </div>
        </section>
    </main>
    <footer>
        <h5 style="text-align: center;">&copy;2023 Car Rental System. All rights reserved.</h5>
        </footer>
</body>
</html>
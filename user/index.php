<?php

session_start();

require_once '../inc/functions.php';
$user_id = $_SESSION['loggedInUserId'];    

checkLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Century Gothic, sans-serif;
            margin: 0;
            padding: 0;
        }

        header, nav, footer {
            background-color: darkblue;
            color: white;
            text-align: center;
            padding: 1em;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>User Dashboard</title>
</head>
<body>
    <header>
	<img src="../assets/img/image.png" alt="Image" style="display: block; margin: 0 auto;">
        <h1>Welcome to Your Dashboard, <?php echo getUsername($_SESSION['loggedInUserId']); ?>!</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../">Home</a></li>
            <li><a href="./">Dashboard</a></li>
            <li><a href="rental.php">Car Rental</a></li>
            <li><a href="return.php">Car Return</a></li>
            <!-- Add more links based on your user dashboard functionalities -->
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>

    <?php if (isset($_SESSION['loginMessage'])) : ?>
        <h3 align='center' style="color: green; margin: 20px 0;"><?= $_SESSION['loginMessage']; ?></h3>
        <?php unset($_SESSION['loginMessage']); endif; ?>
    <main>
        <h2>Dashboard Overview</h2>
        <p>Hello, <?php echo getUsername($_SESSION['loggedInUserId']); ?>! You are logged in as a user<?php //echo $userRole; ?>.</p>
        <p>Email: <?php echo getEmail($_SESSION['loggedInUserId']); ?></p>
        <!-- Add more content based on your user dashboard requirements -->
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Your Car Rental System</p>
    </footer>
</body>
</html>
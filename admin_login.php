<?php

session_start();

if( isset($_SESSION['loggedInAdminId']) ){
    header('location: ./admin/');exit;
}

require_once './inc/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $dbc->real_escape_string( $_POST["admin_username"] );
    $password = $dbc->real_escape_string( $_POST["admin_password"] );

    // TODO: Add authentication logic here
    // For simplicity, validation is not included in this basic example
    // You should check the entered credentials against a database, hash passwords, etc.
    
    $login_sql = "SELECT `id` FROM `admin` WHERE `username`='$username' AND `password`='$password'";
    $query = $dbc->query( $login_sql );
    if( $dbc->affected_rows > 0 ){
        $_SESSION['loggedInAdminId'] = $query->fetch_assoc()['id'];
        $_SESSION['loginMessage'] = "Login success!";
        header('location: ./admin/');exit;
    }
    else {
        $_SESSION['loginMessage'] = "Incorrrect username or password!";
        header('location: ./admin_login.php');exit;
    }

    // Example: Assume authentication is successful
}

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

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: darkblue;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkblue;
        }
    </style>
    <title>Admin Login</title>
</head>
<body>
    <header>
        <img src="assets/img/image.png" alt="Image" style="display: block; margin: 0 auto;">
        <h1>Admin Login</h1>

    </header>

    <form action="admin_login.php" method="post">
        <?php if (isset($_SESSION['loginMessage'])) : ?>
            <p style="color: red;"><?php echo $_SESSION['loginMessage']; ?></p>
        <?php unset($_SESSION['loginMessage']); endif; ?>

        <label for="admin_username">Username:</label>
        <input type="text" id="admin_username" name="admin_username" required>

        <label for="admin_password">Password:</label>
        <input type="password" id="admin_password" name="admin_password" required>

        <input type="submit" value="Login">
        Go back to Home Page <a href="index.php">Home Page</a>
    </form>
    
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>
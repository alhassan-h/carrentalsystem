<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // TODO: Add authentication logic here
    // For simplicity, validation is not included in this basic example
    // You should check the entered credentials against a database, hash passwords, etc.

    // Example: Assume authentication is successful
    $loginMessage = "Login successful!";
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
    <title>Login Page</title>
</head>
<body>
    <header>
        <img src="image.png" alt="Image" style="display: block; margin: 0 auto;">
        <h1>Login to Car Rental System</h1>
    </header>

    <form action="login_page.php" method="post">
        <?php if (isset($loginMessage)) : ?>
            <p style="color: green;"><?php echo $loginMessage; ?></p>
        <?php endif; ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
        Don't have an account? <a href="register.php">Register here</a>
        
        Go back to Home Page <a href="index.php">Home Page</a>
    </form>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>
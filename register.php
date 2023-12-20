<?php

session_start();

if( isset($_SESSION['loggedInUserId']) ){
    header('location: ./user/');exit;
}

require_once './inc/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $dbc->real_escape_string( $_POST["username"] );
    $email = $dbc->real_escape_string( $_POST["email"] );
    $password = $dbc->real_escape_string( $_POST["password"] );
    $confirmPassword = $dbc->real_escape_string( $_POST["confirm_password"] );
    
    // TODO: Add validation and registration logic here
    // For simplicity, validation is not included in this basic example
    // You should perform validation, check for existing users, hash passwords, etc.
    
    $errors = [];
    if ( $password !== $confirmPassword )
        $errors[] = 'Paswords did not match!';

    if( !$errors) {
        $register_sql = "INSERT INTO `users`(`username`,`email`,`password`) 
                        VALUES ('$username','$email','$password')";
        try {
            $query = $dbc->query( $register_sql );
            if( $dbc->affected_rows > 0 ){
                $_SESSION['registrationMessage'] = "Registration successful! Please Login.";
                header('location: login.php');exit;
            }
        } catch (\Throwable $th) {
            $_SESSION['registrationMessage'][] = $dbc->error;
        }
    }else{
        $_SESSION['registrationMessage'] = $errors;
    }
    
    // Example: Assume registration is successful
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

</head>
<body>
    <header>
        <img src="image.png" alt="Image" style="display: block; margin: 0 auto;">
        </div>
        <h1>Register for Car Rental System</h1>
    </header>

    <form action="" method="post">

        <?php if (isset($_SESSION['registrationMessage'])) : 
            foreach($_SESSION['registrationMessage'] as $error) : ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endforeach;
            unset($_SESSION['registrationMessage']);
            endif; 
        ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Register">
         Already have an account? <a href="login.php">Login here</a>
            </div>
            <div class="form-toggle">
                Go back to Home Page <a href="index.php">Home Page</a>
    </form>
    <div class="form-toggle">
             
    </section>
    </main>
    <footer>
        <h5 style="text-align: center;">&copy;2023 Car Rental System. All rights reserved.</h5>
        </footer>
</body>
</html>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // TODO: Add contact form submission logic here
    // For simplicity, validation is not included in this basic example
    // You should validate inputs, send emails, store messages in a database, etc.

    // Example: Assume form submission is successful
    $confirmationMessage = "Thank you for contacting us! We will get back to you soon.";
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
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
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
    <title>Contact Us</title>
</head>
<body>
    <header>
        <img src="image.png" alt="Image" style="display: block; margin: 0 auto;">
        <h1>Contact Us</h1>
        Go back to Home Page <a href="index.php">Home Page</a>
    </header>

    <form action="contact_us.php" method="post">
        <?php if (isset($confirmationMessage)) : ?>
            <p style="color: green;"><?php echo $confirmationMessage; ?></p>
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>


    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>
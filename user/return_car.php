<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $returnDate = $_POST["return_date"];
    $additionalInfo = $_POST["additional_info"];

    // TODO: Add validation and return processing logic here
    // For simplicity, validation is not included in this basic example
    // You should validate inputs, update the rental status, calculate any additional charges, etc.

    // Example: Assume return processing is successful
    $returnMessage = "Your car return request has been submitted!";
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
    <title>Return a Car</title>
</head>
<body>
    <header>
        <img src="image.png" alt="Image" style="display: block; margin: 0 auto;">
        <h1>Return a Car</h1>
    </header>

    <form action="return_car.php" method="post">
        <?php if (isset($returnMessage)) : ?>
            <p style="color: green;"><?php echo $returnMessage; ?></p>
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" required>

        <label for="additional_info">Additional Information:</label>
        <textarea id="additional_info" name="additional_info" rows="4" placeholder="Any additional information about the return"></textarea>

        <input type="submit" value="Submit Return Request">
    </form>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>
<?php
// Sample car information (replace this with actual database retrieval logic)
$carInfo = [
    'carName' => 'Sample Car',
    'carDescription' => 'A comfortable and stylish car for hire.',
    'driverName' => 'John Doe',
    'carImage' => 'uploads/sample_car.jpg', // Replace with the actual path to the image
];

// Sample request status
$requestStatus = 'Pending'; // Initial status when the user submits a request

// Logic to process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: Process the form submission, update the request status in the database, etc.

    // For simplicity, update the sample status
    $requestStatus = 'Pending Approval';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header, nav, footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 10px;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .request-form {
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
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .car-info {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .car-image {
            max-width: 100%;
            height: auto;
        }

        .status {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    <title>Request for Car Hire</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="user-s">
                <a href="request_for_hire.php">Request for Car Hire</a>
            </div>
        </nav>
    </header>

    <div class="car-info">
        <h2><?php echo $carInfo['carName']; ?></h2>
        <p><?php echo $carInfo['carDescription']; ?></p>
        <p>Driver: <?php echo $carInfo['driverName']; ?></p>
        <img class="car-image" src="<?php echo $carInfo['carImage']; ?>" alt="Car Image">
    </div>

    <div class="request-form">
        <h2>Request for Car Hire</h2>
        <form action="request_for_hire.php" method="post">
            <label for="user_name">Your Name:</label>
            <input type="text" id="user_name" name="user_name" required>

            <label for="user_email">Your Email:</label>
            <input type="email" id="user_email" name="user_email" required>

            <label for="user_phone">Your Phone:</label>
            <input type="tel" id="user_phone" name="user_phone" required>

            <label for="user_message">Additional Message:</label>
            <textarea id="user_message" name="user_message" rows="4"></textarea>

            <input type="submit" value="Submit Request">
        </form>

        <?php if ($requestStatus !== 'Pending'): ?>
            <p class="status">Request Status: <?php echo $requestStatus; ?></p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

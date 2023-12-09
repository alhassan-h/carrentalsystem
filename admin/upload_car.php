<?php
// Sample logic to process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $carName = $_POST["car_name"];
    $carDescription = $_POST["car_description"];
    $driverName = $_POST["driver_name"];

    // Process image upload (you may need additional validation and security measures)
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["car_image"]["name"]);
    move_uploaded_file($_FILES["car_image"]["tmp_name"], $targetFile);

    // TODO: Save the data to the database or perform other necessary actions

    // For simplicity, redirect to the same page after submission
    header("Location: admin_dashboard.php");
    exit();
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

        .dashboard-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
	<img src="image.png" alt="Image" style="display: block; margin: 0 auto;
        <nav class="navbar">
            <div class="admin-s">
                <a href="admin_dashboard.php">Admin Dashboard</a>
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a>
            </div>
        </nav>
    </header>

    <div class="dashboard-container">
        <h1>Upload Car</h1>

        <!-- Form to upload car information -->
        <form action="admin_dashboard.php" method="post" enctype="multipart/form-data">
            <label for="car_name">Car Name:</label>
            <input type="text" id="car_name" name="car_name" required>

            <label for="car_description">Car Description:</label>
            <textarea id="car_description" name="car_description" rows="4" required></textarea>

            <label for="driver_name">Driver Name:</label>
            <input type="text" id="driver_name" name="driver_name" required>

            <label for="car_image">Car Image:</label>
            <input type="file" id="car_image" name="car_image" accept="image/*" required>

            <input type="submit" value="Upload Car Information">
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

<?php

session_start();

require_once '../inc/functions.php';

checkAdminLogin();

// Sample logic to process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if( isset($_POST['action']) &&  $_POST['action'] == "delete-car") {
        // Collect form data
        $carId = $dbc->real_escape_string( $_POST["car_id"] );
        $delete_car_sql = "DELETE FROM `cars` WHERE `id`='$carId'";
        $delete_car_query = $dbc->query( $delete_car_sql );
        if ( $dbc->affected_rows > 0 ){
            $_SESSION['uploadMessage'] = "<p style='color: green'>Car deleted successfully!</p>";
            // For simplicity, redirect to the same page after submission
            header('location: ./cars.php');exit;
        }else {
            $_SESSION['uploadMessage'] = "<p style='color: red'>Operation failed!</p>";
            // For simplicity, redirect to the same page after submission
            header('location: ./cars.php');exit;
        }
    }
    elseif( isset($_POST['action']) &&  $_POST['action'] == "upload-car") {
        // Collect form data
        $carName = strtolower($dbc->real_escape_string( $_POST["car_name"] ));
        $carDescription = $dbc->real_escape_string( $_POST["car_description"] );
        $rentPrice = $dbc->real_escape_string( $_POST["rent_price"] );
        $driverName = $dbc->real_escape_string( $_POST["driver_name"] );
        
        // TODO: Save the data to the database or perform other necessary actions
        try {
            // Process image upload (you may need additional validation and security measures)
            $targetDir = "../uploads/cars/";
            $nameArr = explode('.', $_FILES["car_image"]["name"]);
            $extension = end($nameArr);
            $targetFile = str_replace(' ','-', $carName) ."-". time() .".". $extension;
            $saved = move_uploaded_file($_FILES["car_image"]["tmp_name"], "$targetDir$targetFile");
            
            if( $saved ) {
                $upload_car_sql = "INSERT INTO `cars`(`name`,`description`,`price`,`driver`,`image`) VALUES('$carName','$carDescription','$rentPrice','$driverName','$targetFile')";
                $upload_car_query = $dbc->query( $upload_car_sql );
                if ( $dbc->affected_rows > 0 ){
                    $_SESSION['uploadMessage'] = "<p style='color: green'>Car uploaded successfully!</p>";
                    // For simplicity, redirect to the same page after submission
                    header('location: ./cars.php');exit;
                }else {
                    $_SESSION['uploadMessage'] = "<p style='color: red'>Operation failed!</p>";
                    // For simplicity, redirect to the same page after submission
                    header('location: ./cars.php');exit;
                }
            }
            else {
                $_SESSION['uploadMessage'] = "<p style='color: red'>Coudn't save image! Try again.</p>";
                // For simplicity, redirect to the same page after submission
                header('location: ./cars.php');exit;
            }
        } catch (\Throwable $th) {
            $_SESSION['uploadMessage'] = "<p style='color: red'>$dbc->error!</p>";
            // For simplicity, redirect to the same page after submission
            header('location: ./cars.php');exit;
        }
    }
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
        .car-info {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
	<img src="../assets/img/image.png" alt="Image" style="display: block; margin: 0 auto;">
        <nav class="navbar">
            <div class="admin-s">
                <a style="color: white; margin-right: 10px" href="./">Admin Dashboard</a>
				<a style="color: white" href="../logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <div class="dashboard-container">
        <h2 align="center">Upload a Car</h2>
        <!-- Form to upload car information -->
        <form action="" method="post" enctype="multipart/form-data">
            
            <?php if (isset($_SESSION['uploadMessage'])) : ?>
            <?php echo $_SESSION['uploadMessage']; unset($_SESSION['uploadMessage']); endif; ?>

            <input type="hidden" name="action" value="upload-car" required>

            <label for="car_name">Car Name:</label>
            <input type="text" id="car_name" name="car_name" required>

            <label for="car_description">Car Description:</label>
            <textarea id="car_description" name="car_description" rows="4" required></textarea>

            <label for="driver_name">Driver Name:</label>
            <input type="text" id="driver_name" name="driver_name" required>
            
            <label for="rent_price">Rent Price:</label>
            <input type="text" id="rent_price" name="rent_price" required>

            <label for="car_image">Car Image:</label>
            <input type="file" id="car_image" name="car_image" accept="image/*" required>

            <input type="submit" value="Upload Car Information">
        </form>
    </div>
    <div class="dashboard-container">
        <h2 align="center">Uploaded Cars</h2>
        <?php
        $cars_sql = "SELECT * FROM `cars` ORDER BY `id` DESC";
        $result = $dbc->query( $cars_sql );
        if ($dbc->affected_rows > 0) {
            while ( $car = $result->fetch_assoc()) {
                $car_id = $car['id'];
                $name = $car['name'];
                $description = $car['description'];
                $price = $car['price'];
                $driver = $car['driver'];
                $image = $car['image'];
                ?>
                <div class="car-info">
                    <div class="rented-car" style="display: flex; justify-content: space-between; align-items: center">
                        <div class="details">
                            <h2><?= ucwords($name); ?></h2>
                            <p style="margin: 0 0 3px;">Desc: <?= ucfirst($description); ?></p>
                            <p style="margin: 0 0 3px;">Price: &#8358; <?= number_format($price); ?></p>
                            <p style="margin: 0 0 3px;">Driver: <?= ucwords($driver); ?></p>
                        </div>
                        <div class="preview">
                            <img class="" style="width: 300px;" src="../uploads/cars/<?= $car['image']; ?>" alt="Car Image">
                        </div>
                    </div>
                    <div class="">
                        <form action="" method="post" style="border: none; padding:0;">
                            <input type="hidden" name="action" value="delete-car">
                            <input type="hidden" name="car_id" value="<?= $car_id;?>">
                            <input style="background-color: red;" type="submit" value="Delete Car">
                        </form>
                    </div>
                </div>
                <?php
            }
        } ?> 
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

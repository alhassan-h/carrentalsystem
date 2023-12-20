<?php

session_start();

require_once '../inc/functions.php';
$user_id = $_SESSION['loggedInUserId'];    

checkLogin();

// Check if the form is submitted
if(isset($_POST['action']) &&  $_POST['action'] == "return-car"){
    // Collect form data
    $rental_id = $dbc->real_escape_string($_POST['rental_id']);
    $rating = $dbc->real_escape_string($_POST['rating']);
    
    $default_rating = ($rating)?",`rating`='$rating'":"";
    $sql = "UPDATE `rentals` SET `return_datetime`=CURRENT_TIMESTAMP()$default_rating WHERE `id`='$rental_id'";

    $query = $dbc->query( $sql );
    if($dbc->affected_rows > 0 ){
        $_SESSION['payment_msgs'] = '<p style="color:green">You have successfully returned a car!</p>';
        header('location: ./return.php');exit;
    }else{
        $_SESSION['payment_msgs'] = '<p style="color:red">Operation Failed!</p>';
        header("location: ./return.php");exit;
    }
    
}

$car_sql = "SELECT `c`.*, `r`.`id` AS `rental_id`,`r`.`rent_datetime` FROM `rentals` `r`
INNER JOIN `users` `u` ON `r`.`user_id`=`u`.`id`
INNER JOIN `cars` `c` ON `r`.`car_id`=`c`.`id`
WHERE `u`.`id`='$user_id' AND `r`.`return_datetime` IS NULL";
$car = $dbc->query( $car_sql )->fetch_assoc();

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
    <title>Car Return</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="user-s">
                <a href="./">Back to Dashboard</a>
            </div>
        </nav>
    </header>
    <h1 align="center">Car Return</h1>
    <div class="car-info">
        <?php if (isset($_SESSION['payment_msgs'])) : ?>
            <?= $_SESSION['payment_msgs']; ?>
            <?php   unset($_SESSION['payment_msgs']);
            endif; 
        ?>
        <div class="rented-car" style="display: flex; justify-content: space-between; align-items: center">
            <?php if ( $car ) : ?>
                <div class="details">
                    <h2><?= ucwords($car['name']); ?></h2>
                    <p style="margin: 0 0 3px;">Desc: <?= ucfirst($car['description']); ?></p>
                    <p style="margin: 0 0 3px;">Price: &#8358; <?= number_format($car['price']); ?></p>
                    <p style="margin: 0 0 3px;">Driver: <?= ucwords($car['driver']); ?></p>
                    <p style="margin: 0 0 3px;">Rent Date: <?= date('M j, Y',strtotime($car['rent_datetime'])); ?></p>
                    <p style="margin: 0 0 3px;">Rent Time: <?= date('h:i A',strtotime($car['rent_datetime'])); ?></p>
                </div>
                <div class="preview">
                    <img class="" style="width: 300px;" src="../uploads/cars/<?= $car['image']; ?>" alt="Car Image">
                </div>
            <?php else : ?>
                <h3>You have no hired cars</h3>
                <a style="color: black;" href="./rental.php">Hire Car Now</a>
            <?php    endif; ?>
        </div>
    </div>
    <?php if ( $car ) : ?>
        <div class="request-form">
        <h2>Return Rented Car</h2>
        <form action="" method="post">
            <input type="hidden" name="action" value="return-car">
            <input type="hidden" name="rental_id" value="<?= $car['rental_id']; ?>">

            <label for="rating">Rate Your Driver:</label>
            <input type="text" id="rating" name="rating" placeholder="Good...">

            <input type="submit" value="Return Car">
        </form>
        </div>
    <?php    endif; ?>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

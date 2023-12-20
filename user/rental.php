<?php

session_start();

require_once '../inc/functions.php';
$user_id = $_SESSION['loggedInUserId'];    

checkLogin();

$rental_sql = "SELECT `c`.*, `r`.`rent_datetime` FROM `rentals` `r`
INNER JOIN `users` `u` ON `r`.`user_id`=`u`.`id`
INNER JOIN `cars` `c` ON `r`.`car_id`=`c`.`id`
WHERE `u`.`id`='$user_id' AND `r`.`return_datetime` IS NULL";
$car = $dbc->query( $rental_sql )->fetch_assoc();

$cars_sql = "SELECT * FROM `cars` ORDER BY `id` DESC";

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
                <a href="./">Back to Dashboard</a>
            </div>
        </nav>
    </header>

    <?php
        if( $car ){ ?>
            <div class="car-info">
                <h2 style="color: red;">You are currently renting a car!</h2>
                <h4 style="color: blue;">Return it to rent another one</h4>
                <br>
                <a style="color: black;" href="./return.php">Return Car Now</a>
            </div>
            <?php
        }else{
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
                        <div class="car" style="display: flex; justify-content: space-between; align-items: center;margin: 0 0 50px;">
                            <div class="details">
                                <h2><?= ucwords($car['name']); ?></h2>
                                <p style="margin: 0 0 3px;">Desc: <?= ucfirst($car['description']); ?></p>
                                <p style="margin: 0 0 3px;">Price: &#8358; <?= number_format($car['price']); ?></p>
                                <p style="margin: 0 0 3px;">Driver: <?= ucwords($car['driver']); ?></p>
                            </div>
                            <div class="preview">
                                <img class="" style="width: 300px;" src="../uploads/cars/<?= $car['image']; ?>" alt="Car Image">
                            </div>
                        </div>
                        <div class="">
                            <form action="payment.php" method="post">
                                <input type="hidden" name="action" value="make-request">
                                <input type="hidden" name="car_id" value="<?= $car_id;?>">
                                <input style="margin: 0;" type="submit" value="Rent Car">
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    ?>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

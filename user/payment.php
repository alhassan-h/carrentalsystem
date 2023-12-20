<?php

session_start();

require_once '../inc/functions.php';
$user_id = $_SESSION['loggedInUserId'];    

checkLogin();   

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ( isset($_POST['action']) &&  $_POST['action'] == "make-request") {
        $car_id = $dbc->real_escape_string( $_POST["car_id"] );
        $car_sql = "SELECT * FROM `cars` WHERE `id`='$car_id'";
        
    }
    elseif(isset($_POST['action']) &&  $_POST['action'] == "make-payment"){
        // Collect form data
        $msgs = [];

        $car_id = $dbc->real_escape_string($_POST['car_id']);
        $car_price = $dbc->real_escape_string($_POST['car_price']);
        $cardno = $dbc->real_escape_string($_POST['cardno']);
        $expiry = $dbc->real_escape_string($_POST['expiry']);
        $cvv = $dbc->real_escape_string($_POST['cvv']);
        $password = $dbc->real_escape_string($_POST['password']);
    
        if( strlen($cardno) < 10)
            $msgs[] = '<p style="color: red">Card number must be at least 10 digits!</p>';
        if( strlen($expiry) !== 5)
            $msgs[] = '<p style="color: red">Expiry date must be exactly 5 characters!</p>';
        if( strlen($cvv) !== 3)
            $msgs[] = '<p style="color: red">CVV must be exactly 3 digits!</p>';
        
        if( !$msgs ){
        
            $sql = "INSERT INTO `rentals`(`user_id`,`car_id`,`price`,`rent_datetime`)
            VALUES('$user_id','$car_id','$car_price',CURRENT_TIMESTAMP())";
                
            $query = $dbc->query( $sql );
        
            if($dbc->affected_rows > 0 ){
                $_SESSION['payment_msgs'][] = '<p style="color:green">Congratulations!</p>
                <p style="color:green">You have successfully rented a car!</p>';
                header('location: ./return.php');exit;
            }else{
                $_SESSION['payment_msgs'][] = '<p style="color:red">Operation Failed!</p>';
                header("location: ./payment.php?car_id=$car_id");exit;
            }
        }
        else{
            $_SESSION['payment_msgs'] = $msgs;
            header("location: ./payment.php?car_id=$car_id");exit;
        }
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['car_id'])) {
    $car_id = $dbc->real_escape_string( $_GET["car_id"] );
    $car_sql = "SELECT * FROM `cars` WHERE `id`='$car_id'";
}
else{
    header('location: ./rental.php');exit;
}

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
    <title>Pay for Car Hire</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="user-s">
                <a href="rental.php">Back to Rental Page</a>
            </div>
        </nav>
    </header>
    <h1 align="center">Car Hire Payment</h1>

    <div class="car-info" style="display: flex; justify-content: space-between; align-items: center">
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

    <div class="request-form">
        <h2>Provide Your Payment Details</h2>
        <?php if (isset($_SESSION['payment_msgs'])) : 
            foreach($_SESSION['payment_msgs'] as $error) : ?>
                <?php echo $error; ?>
            <?php endforeach;
            unset($_SESSION['payment_msgs']);
            endif; 
        ?>
        <form action="" method="post">
            <input type="hidden" name="action" value="make-payment">
            <input type="hidden" name="car_id" value="<?= $car['id']; ?>">
            <input type="hidden" name="car_price" value="<?= $car['price']; ?>">

            <label for="cardno">Card Number:</label>
            <input type="text" id="cardno" name="cardno" required>

            <label for="expiry">Expiry Date:</label>
            <input type="text" id="expiry" name="expiry" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <input type="submit" value="Make Payment">
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

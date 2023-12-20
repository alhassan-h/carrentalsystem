<?php

session_start();

require_once '../inc/functions.php';

checkAdminLogin();

// Check if the form is submitted
if ( isset($_POST['action']) && $_POST['action'] == "delete-user") {
    $user_id = $dbc->real_escape_string( $_POST["user_id"] );
    $delete_user_sql = "DELETE FROM `users` WHERE `id`='$user_id'";
    $delete_user_query = $dbc->query( $delete_user_sql );
    $_SESSION['msg'] = ( $dbc->affected_rows > 0)?"User deleted successfully!":"";
    header('location: ./');exit;
}
elseif ( isset($_POST['action']) && $_POST['action'] == "retrieve-car") {
    $rental_id = $dbc->real_escape_string( $_POST["rental_id"] );
    $retrieve_car_sql = "UPDATE `rentals` SET `return_datetime`=CURRENT_TIMESTAMP() WHERE `id`='$rental_id'";
    $retrieve_car_query = $dbc->query( $retrieve_car_sql );
    $_SESSION['msg'] = ( $dbc->affected_rows > 0)?"Car retrieved successfully!":"";
    header('location: ./');exit;
}

$users_sql = "SELECT * FROM `users`";

$rental_sql = "SELECT `c`.`name` AS `car_name`, `u`.`username` AS `username`,
`u`.`email` AS `email`, `r`.`id` AS `rental_id`,`r`.`rent_datetime` AS `date`,`r`.`price` AS `price`
FROM `rentals` `r`
INNER JOIN `users` `u` ON `r`.`user_id`=`u`.`id`
INNER JOIN `cars` `c` ON `r`.`car_id`=`c`.`id`
WHERE `r`.`return_datetime` IS NULL";

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
            color: s;
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
            color: skyblue
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

        .user-requests, .user-management {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: darkblue;
            color: white;
        }

        .status {
            font-weight: bold;
        }
    </style>
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <img src="../assets/img/image.png" alt="Image" style="display: block; margin: 0 auto;">
		<nav class="navbar">
            <div class="user-s">
                <a style="color: white; margin-right: 10px" href="../">Home</a>
                <a style="color: white; margin-right: 10px" href="./">Admin Dashboard</a>
                <a style="color: white; margin-right: 10px" href="./cars.php">Car Management</a>
				<a style="color: white" href="../logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <?php if (isset($_SESSION['loginMessage'])) : ?>
        <h3 align='center' style="color: green; margin: 20px 0;"><?= $_SESSION['loginMessage']; ?></h3>
    <?php unset($_SESSION['loginMessage']); endif; ?>
    <div class="dashboard-container">
        
        <h1 style="color: blue; margin: 0 0 40px 0">Admin Dashboard</h1>

		<?php if ( isset($_SESSION['msg'])) : ?>
            <p style="color: green; margin: 20px 0"><?= $_SESSION['msg']; ?></p>
        <?php unset($_SESSION['msg']); endif; ?>

		<!-- User Requests Section -->
        <div class="user-requests">
            <h3>Rented Cars</h3>
            <table>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>User</th>
                        <th>Car Name</th>
                        <th>Rent Date</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = $dbc->query( $rental_sql );
                    $sn = 1;
                    while ($rental = $query->fetch_assoc()): ?>
                        <tr>
                            <td><?= $sn++; ?></td>
                            <td>
                                <h4 style="margin: 0 0 2px"><?= ucfirst($rental['username']); ?></h4>
                                <h4 style="margin: 0 0 2px; font-weight: lighter"><?= strtolower($rental['email']); ?></h4>
                            </td>
                            <td><?= ucwords($rental['car_name']); ?></td>
                            <td><?= date('M j, Y @ h:i A',strtotime($rental['date'])); ?></td>
                            <td>&#8358; <?= number_format($rental['price']); ?></td>
                            <td>
                                <!-- Add action buttons or links (edit, delete, etc.) -->
                                <form action="" method="post">
                                    <input type="hidden" name="action" value="retrieve-car">
                                    <input type="hidden" name="rental_id" value="<?= $rental['rental_id']; ?>">
                                    <button type="submit">Retieve Car</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- User Management Section -->
        <div class="user-management">
            <h3>User Management</h3>
            <table>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = $dbc->query( $users_sql );
                    $sn = 1;
                    while ($user = $query->fetch_assoc()): ?>
                        <tr>
                            <td><?= $sn++; ?></td>
                            <td><?= $user['id']; ?></td>
                            <td><?= ucfirst($user['username']); ?></td>
                            <td><?= strtolower($user['email']); ?></td>
                            <td>
                                <!-- Add action buttons or links (edit, delete, etc.) -->
                                <form action="" method="post">
                                    <input type="hidden" name="action" value="delete-user">
                                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>

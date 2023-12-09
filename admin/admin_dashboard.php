<?php
// Sample user requests (replace this with actual database retrieval logic)
$userRequests = [
    [
        'userName' => 'John Doe',
        'userEmail' => 'john@example.com',
        'userPhone' => '123-456-7890',
        'userMessage' => 'I would like to rent a car for the weekend.',
        'requestStatus' => 'Pending',
    ],
    // Add more sample requests as needed
];

// Sample user data (replace this with actual database retrieval logic)
$users = [
    [
        'userId' => 1,
        'userName' => 'Alice Smith',
        'userEmail' => 'alice@example.com',
        'userPhone' => '987-654-3210',
    ],
    [
        'userId' => 2,
        'userName' => 'Bob Johnson',
        'userEmail' => 'bob@example.com',
        'userPhone' => '567-890-1234',
    ],
    // Add more sample users as needed
];
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
        <img src="image.png" alt="Image" style="display: block; margin: 0 auto;
		<nav class="navbar">
            <div class="user-s">
                <a href="admin_dashboard.php">Admin Dashboard</a>
				<a href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>

        <!-- Up load Car Section-->
        <a href="upload_car.php">Upload Car</a>
		
		<!-- User Requests Section -->
        <div class="user-requests">
            <h3>User Car Requests</h3>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userRequests as $request): ?>
                        <tr>
                            <td><?php echo $request['userName']; ?></td>
                            <td><?php echo $request['userEmail']; ?></td>
                            <td><?php echo $request['userPhone']; ?></td>
                            <td><?php echo $request['userMessage']; ?></td>
                            <td class="status"><?php echo $request['requestStatus']; ?></td>
                            <td>
                                <!-- Add action buttons or links (approve, reject, etc.) -->
                                <button>Approve</button>
                                <button>Reject</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- User Management Section -->
        <div class="user-management">
            <h3>User Management</h3>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['userId']; ?></td>
                            <td><?php echo $user['userName']; ?></td>
                            <td><?php echo $user['userEmail']; ?></td>
                            <td><?php echo $user['userPhone']; ?></td>
                            <td>
                                <!-- Add action buttons or links (edit, delete, etc.) -->
                                <button>Edit</button>
                                <button>Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>


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

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>User Dashboard</title>
</head>
<body>
    <header>
	<img src="image.png" alt="Image" style="display: block; margin: 0 auto;
        <h1>Welcome to Your Dashboard, <?php echo $userName; ?>!</h1>
    </header>

    <nav>
        <ul>
            <li><a href="user_dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <!-- Add more links based on your user dashboard functionalities -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <h2>Dashboard Overview</h2>
        <p>Hello, <?php echo $userName; ?>! You are logged in as a <?php echo $userRole; ?>.</p>
        <p>Email: <?php echo $userEmail; ?></p>
        <!-- Add more content based on your user dashboard requirements -->
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Your Car Rental System</p>
    </footer>
</body>
</html>
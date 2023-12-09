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
    </style>
    <title>About Us</title>
</head>
<body>
    <header>
        <img src="image.png" alt="Image" style="display: block; margin: 0 auto;">
        <h1>About Us</h1>
        Go back to Home Page <a href="index.php">Home Page</a>
    </header>

    <main>
        <p>Welcome to Car Rental System!</p>

        <p>We are a leading car rental company committed to providing high-quality services to our customers. With a diverse fleet of well-maintained vehicles, we offer flexible rental options to meet your transportation needs.</p>

        <p>Our mission is to make your journey enjoyable and hassle-free. Whether you're a business traveler or on vacation, we strive to provide reliable and affordable rental solutions. Our experienced team is dedicated to ensuring your satisfaction from booking to return.</p>

        <p>Thank you for choosing Car Rental System. We look forward to serving you and making your travel experience memorable.</p>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Car Rental System</p>
    </footer>
</body>
</html>
<?php
session_start(); // Start session

$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_management";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_hero = "SELECT * FROM hero LIMIT 1";
$result_hero = $conn->query($sql_hero);
$hero = $result_hero->fetch_assoc();

$sql_services = "SELECT * FROM services";
$result_services = $conn->query($sql_services);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql_insert_message = "INSERT INTO contact_messages (name, lastname, phone, message, user_id) VALUES ('$name', '$lastname', '$phone', '$message', {$_SESSION['user_id']})";
    
    if ($conn->query($sql_insert_message) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - The Mark New York</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>The Mark New York</h1>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="location.php">Location</a></li>
                <li><a href="contact.php" class="active">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <section class="contact-info">
            <h3>Our Location</h3>
            <p><strong>Address:</strong> 123 Main Street, New York, NY</p>
            <p><strong>Email:</strong> contact@themarknewyork.com</p>
            <p><strong>Phone:</strong> +1 123 456 7890</p>
        </section>

        <?php if (isset($_SESSION['user_id'])): ?>
            <section class="contact-form">
                <h3>Send Us a Message</h3>
                <form action="contact.php" method="POST">
                    <label for="name">First Name</label>
                    <input type="text" name="name" id="name" required>

                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" required>

                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" required>

                    <label for="message">Your Message</label>
                    <textarea name="message" id="message" rows="5" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </section>
        <?php else: ?>
            <p>Please <a href="login.php">log in</a> to send a message.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>© 2024 The Mark New York. All rights reserved.</p>
    </footer>
</body>
</html>

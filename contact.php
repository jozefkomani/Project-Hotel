<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_management";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message) 
            VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!'); window.location='contact.php';</script>";
    } else {
        echo "upss " . $conn->error;
    }
}

$conn->close();
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
    
    <div class="container">
        <h3>Send Us a Message</h3>
        <form action="contact.php" method="POST">
    <table>
        <tr>
            <td><label for="name">Full Name:</label></td>
            <td><input type="text" name="name" id="name" required></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" name="email" id="email" required></td>
        </tr>
        <tr>
            <td><label for="message">Your Message:</label></td>
            <td><textarea name="message" id="message" rows="5" required></textarea></td>
        </tr>
    </table>
    <button type="submit">Send Message</button>
</form>

    </div>
    
    <footer>
        <p>© 2024 The Mark New York. All rights reserved.</p>
    </footer>
</body>
</html>

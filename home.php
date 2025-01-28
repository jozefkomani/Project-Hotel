<?php
session_start(); // Fillon sesionin

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Our Hotel</title>
  <link rel="stylesheet" href="style.css">
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
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="reviews.php">Reviews</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        
        <?php if (!isset($_SESSION['user_id'])): ?> 
          <li><a href="login.php">Login</a></li>
        <?php else: ?>
          <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
        
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <img src="<?php echo $hero['image_url']; ?>" alt="Luxury Hotel" class="hero-image">
      <div class="hero-text">
        <h2><?php echo $hero['title']; ?></h2>
        <p><?php echo $hero['description']; ?></p>
        <div class="hero-buttons">
          <a href="location.php" class="btn">Explore Location</a>
          <a href="contactus.php" class="btn btn-secondary">Book Now</a>
          <a href="gallery.php" class="btn btn-secondary">View Rooms</a>
          <a href="products.php" class="btn btn-secondary">Special Offers</a>
        </div>
      </div>
    </section>

    <section class="services">
      <h2>Our Services</h2>
      <div class="service-list">
        <?php while ($service = $result_services->fetch_assoc()) { ?>
        <div class="service-item">
          <img src="<?php echo $service['image_url']; ?>" alt="<?php echo $service['name']; ?>">
          <h3><?php echo $service['name']; ?></h3>
          <p><?php echo $service['description']; ?></p>
        </div>
        <?php } ?>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2024 The Mark New York. All rights reserved.</p>
  </footer>
</body>
</html>

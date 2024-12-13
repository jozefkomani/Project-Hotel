<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_management";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM about WHERE id = 1";
$result = $conn->query($sql);
$about = $result->fetch_assoc();

$sql_images = "SELECT * FROM about_images WHERE about_id = 1";
$result_images = $conn->query($sql_images);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | The Mark New York</title>
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
        <li><a href="products.php">Products</a></li>
        <li><a href="fitness.php">Fitness</a></li>
        <li><a href="location.php">Location</a></li>
        <li><a href="about.php">About Us</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="about">
      <h2><?php echo $about['title']; ?></h2>
      <p><?php echo $about['description']; ?></p>
      <div class="image-grid">
        <?php while ($image = $result_images->fetch_assoc()): ?>
          <img src="<?php echo $image['image_url']; ?>" alt="<?php echo $image['alt_text']; ?>">
        <?php endwhile; ?>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2024 The Mark New York. All rights reserved.</p>
  </footer>
</body>
</html>

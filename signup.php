<?php
session_start();

$servername = "localhost";
$db = "hotel_management";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$message = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if ($password !== $confirmPassword) {
        $message = "Passwords do not match!";
    } elseif (empty($username) || empty($email) || empty($password)) {
        $message = "Please fill out all fields!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, "user")';
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        try {
            if ($stmt->execute()) {
                $_SESSION['email'] = $email;
                header("Location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            if ($e->getCode() === "23000") { 
                $message = "This email is already registered!";
            } else {
                $message = "An error occurred: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="signup">
        <h2>Signup</h2>

        <?php if (!empty($message)) : ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form method="post">
            <div class="user username">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="user email">
                <input type="email" name="email" placeholder="example@gmail.com" required>
            </div>

            <div class="user password">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="user confirm-password">
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
            </div>

            <button type="submit" name="submit">Signup</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_management";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $role);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['role'] = $role;

                if ($role === 'admin') {
                    header('Location: admin_dashboard.php');
                } else {
                    header('Location: home.php');
                }
                exit();
            } else {
                $error = "Incorrect email or password!";
            }
        } else {
            $error = "Incorrect email or password!";
        }
        $stmt->close();
    } else {
        $error = "Please fill in all fields!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <div class="login">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post" onsubmit="return validationForm()">
            <div class="user email">
                <input id="email" type="email" name="email" placeholder="example@gmail.com" required>
            </div>

            <div class="user password">
                <input id="password" type="password" name="password" placeholder="Password" required minlength="6">
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>

    <script>
        function validationForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email!');
                return false;
            }

            if (password.length < 6) {
                alert('Password must be at least 6 characters long!');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

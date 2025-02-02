<?php
session_start();
require_once 'crud/functions.php';

$conn = connectDatabase();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteUser($conn, $id);
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emri'], $_POST['username'], $_POST['email'], $_POST['password'])) {
    $emri = $_POST['emri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    addUser($conn, $emri, $email, $username, $password);
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <form method="post" action="logout.php" style="float: right;">
        <button type="submit" name="logout">Logout</button>
    </form>

    <h3>Menage</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>
        <?php
        $users = getUsers($conn);
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['emri'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['role'] . "</td>";
            echo "<td><a href='admin_dashboard.php?delete=" . $user['id'] . "' onclick='return confirm(\"A je i sigurt?\")'>Fshi</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h3>Add User</h3>
<form method="post" action="admin_dashboard.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Add</button>
</form>

</body>
</html>

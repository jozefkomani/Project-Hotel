<?php
session_start();

$_SESSION = array();

$_SESSION['logged_out'] = true;

session_destroy();

header("Location: index.php");
exit();
?>

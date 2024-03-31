<?php
require 'session.php'; // Include session.php where your session-related functions are defined
require 'database.php'; // Include database.php to establish database connection

// Check if user is logged in, if not, redirect to login page
redirectToLogin();

// Now you can continue with the rest of your code

$userEmail = $_SESSION['email'];
$sql = "SELECT * FROM reservations WHERE email = '$userEmail'";
$result = $conn->query($sql);

// Your other code here
?>

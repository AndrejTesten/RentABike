<?php
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bikes';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bicycles";
$result = $conn->query($sql);

$conn->close();
?>
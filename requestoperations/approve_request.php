<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bikes';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reservationId = $_GET['id'];

$sql = "UPDATE reservations SET status='Potrjeno' WHERE id='$reservationId'";

if ($conn->query($sql) === TRUE) {
    echo "Rezervacija odobrena";
    header("Location: ..\crm");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

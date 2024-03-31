<?php 
require '../includes/database.php';
$reservationId = $_GET['id'];

$sql = "UPDATE reservations SET status='Zavrnjeno' WHERE id='$reservationId'";

if ($conn->query($sql) === TRUE) {
    echo "Rezervacija odbijena";
    header("Location: ..\crm.php");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

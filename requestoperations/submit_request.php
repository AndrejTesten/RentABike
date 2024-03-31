<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bikes';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];

    $sql = "INSERT INTO reservations (model, name, email, date_from, date_to) VALUES ('$model','$name', '$email', '$dateFrom', '$dateTo')";
    if ($conn->query($sql) === true) {
        header("Location: ../index");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

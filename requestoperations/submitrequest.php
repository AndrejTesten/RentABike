<?php 
require '../includes/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];

    $checkAvailabilityQuery = "SELECT * FROM reservations WHERE model = ? 
                               AND ((date_from <= ? AND date_to >= ?) OR (date_from <= ? AND date_to >= ?))";
    $checkStmt = $conn->prepare($checkAvailabilityQuery);
    $checkStmt->bind_param("sssss", $model, $dateFrom, $dateFrom, $dateTo, $dateTo);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Bike is already reserved for some part of the selected date range
        echo "Selected dates are not available for this bike. Please choose different dates.";
    } else {
        // Insert the reservation into the database
        $insertQuery = "INSERT INTO reservations (model, name, email, date_from, date_to) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssss", $model, $name, $email, $dateFrom, $dateTo);
        if ($insertStmt->execute()) {
            header("Location: ../index.php"); // Redirect on successful reservation
            exit();
        } else {
            echo "Error inserting reservation: " . $insertStmt->error;
        }
    }
} else {
    // Handle invalid request or user not logged in
    echo "Invalid request or user not logged in.";
}

$conn->close();
?>
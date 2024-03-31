<?php
// Include session handling file
require_once 'includes/session.php';

// Check if user is logged in, redirect to login page if not logged in
redirectToLogin();

// Include database connection file
require_once 'includes/database.php';

if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $deleteQuery = "DELETE FROM reservations WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $reservationId);

    if ($deleteStmt->execute()) {
        header('Location: myreservation.php');
        exit();
    } else {
        echo 'Brisanje neuspesno';
        exit();
    }
} else {
    echo 'Rezervacija ne obstaja';
    exit();
}
?>

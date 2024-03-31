<?php
require '../includes/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the message into the database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Message inserted successfully
        echo '<div class="alert alert-success" role="alert">
                Your message has been sent successfully.
              </div>';
    } else {
        // Error inserting message
        echo '<div class="alert alert-danger" role="alert">
                Oops! Something went wrong. Please try again later.
              </div>';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect back to the contact page
    header("Location: index.php#kontakt");
    exit();
}
?>

<?php
// Include session handling and database connection files
require_once 'session.php';
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $userType = 'user'; // Assuming all signups are for regular users

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $signupError = "Passwords do not match.";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkEmailQuery);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $signupError = "Email already exists.";
        } else {
            // Insert new user into the database with hashed password
            $insertQuery = "INSERT INTO users (email, password, user_type) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("sss", $email, $hashedPassword, $userType);
            $insertStmt->execute();

            // Redirect user to login page after successful signup
            header("Location: ../index.php");
            exit();
        }
    }
}
?>

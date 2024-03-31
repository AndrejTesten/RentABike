<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/database.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        echo "Stored Hashed Password: " . $storedPassword . "<br>";

        if (password_verify($password, $storedPassword)) {
            $userType = $row['user_type'];
            $_SESSION['email'] = $email;

            if ($userType == 'user') {
                header("Location: ../index.php");
                exit();
            } elseif ($userType == 'admin') {
                header("Location: ../crm.php");
                exit();
            } else {
                echo "Unknown user type.";
            }
        } else {
            $loginError = "Invalid email or password.";
            echo "Invalid email or password.";
        }
    } else {
        $loginError = "Invalid email or password.";
        echo "Invalid email or password.";
    }
}

$conn->close();
?>

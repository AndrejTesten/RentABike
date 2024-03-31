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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userType = $row['user_type'];
        $_SESSION['email'] = $email;

        if ($userType == 'user') {
            header("Location: ../index.php");
        } elseif ($userType == 'admin') {
            header("Location: ../crm.php");
        } else {
            echo "Neznan uporabnik";
        }
        
        exit();
    } else {
        $loginError = "Invalid email or password.";
        echo  "Napačno geslo ali email";
    }
}

$conn->close();
?>

<?php
session_start();

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['email']);
}

// Redirect to login page if not logged in
function redirectToLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Logout user
function logout() {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>

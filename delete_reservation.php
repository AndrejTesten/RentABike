<?php
require 'loginoperations\checklogin.php';

if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    $deleteQuery = "DELETE FROM reservations WHERE id = $reservationId";
    if ($conn->query($deleteQuery) === true) {
        header('Location: myreservations.php');
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
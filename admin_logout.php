<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "hotel_booking");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = intval($_GET['id']);
    $conn->query("DELETE FROM bookings WHERE id=$id");
}

header("Location: view_bookings.php");
exit;


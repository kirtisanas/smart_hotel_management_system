<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "hotel_booking");

$id = $_GET['id'];

// Optional: delete image file too
$result = $conn->query("SELECT image FROM rooms WHERE id=$id");
$row = $result->fetch_assoc();
if ($row['image'] && file_exists($row['image'])) {
    unlink($row['image']);
}

$conn->query("DELETE FROM rooms WHERE id=$id");

header("Location: view_rooms.php");
exit;
?>

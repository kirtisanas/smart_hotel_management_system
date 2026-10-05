<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$room_id = $_GET['room_id'];
$check_in = $_GET['check_in'];
$check_out = $_GET['check_out'];

// Insert booking into DB
$sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out) 
        VALUES ('$user_id', '$room_id', '$check_in', '$check_out')";

if (mysqli_query($conn, $sql)) {
    echo "✅ Room booked successfully!<br><a href='view_bookings.php'>View My Bookings</a>";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}
?>

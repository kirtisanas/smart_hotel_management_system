<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Welcome, Admin!</h2>
    <p>✅ You are logged in.</p>

    <a href="view_bookings.php" class="btn btn-primary">View Bookings</a><br>
 <a href="add_room.php" class="btn btn-success mb-2">➕ Add Room</a><br>
    <a href="view_rooms.php" class="btn btn-info mb-2">🏨 Manage Rooms</a><br>
    <a href="admin_logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>

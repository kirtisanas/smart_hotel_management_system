<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "hotel_booking");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $room_type = $_POST['room_type'];

    $stmt = $conn->prepare("UPDATE bookings SET name=?, email=?, check_in=?, check_out=?, room_type=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $check_in, $check_out, $room_type, $id);
    $stmt->execute();
    header("Location: view_bookings.php");
    exit;
}

$result = $conn->query("SELECT * FROM bookings WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <h3>Edit Booking</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Check-in:</label>
            <input type="date" name="check_in" value="<?= $row['check_in'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Check-out:</label>
            <input type="date" name="check_out" value="<?= $row['check_out'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Room Type:</label>
            <input type="text" name="room_type" value="<?= $row['room_type'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Update Booking</button>
        <a href="view_bookings.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

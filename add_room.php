<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "hotel_booking");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image upload handling (optional)
    $image = '';
    if ($_FILES['image']['name']) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $stmt = $conn->prepare("INSERT INTO rooms (room_name, room_type, price, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $room_name, $room_type, $price, $description, $image);
    $stmt->execute();

    header("Location: view_rooms.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Room</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Room Name</label>
            <input type="text" name="room_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Room Type</label>
            <input type="text" name="room_type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price (per night)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label>Room Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Room</button>
    </form>
</div>
</body>
</html>

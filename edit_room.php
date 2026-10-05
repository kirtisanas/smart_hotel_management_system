<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "hotel_booking");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM rooms WHERE id=$id");
$room = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle image update if new image uploaded
    if ($_FILES['image']['name']) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = $room['image'];
    }

    $stmt = $conn->prepare("UPDATE rooms SET room_name=?, room_type=?, price=?, description=?, image=? WHERE id=?");
    $stmt->bind_param("ssdssi", $room_name, $room_type, $price, $description, $image, $id);
    $stmt->execute();

    header("Location: view_rooms.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Room</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Room Name</label>
            <input type="text" name="room_name" class="form-control" value="<?= $room['room_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Room Type</label>
            <input type="text" name="room_type" class="form-control" value="<?= $room['room_type'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $room['price'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"><?= $room['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Image (leave blank to keep old)</label>
            <input type="file" name="image" class="form-control">
            <?php if ($room['image']) { ?>
                <img src="<?= $room['image'] ?>" width="100" class="mt-2">
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Update Room</button>
    </form>
</div>
</body>
</html>

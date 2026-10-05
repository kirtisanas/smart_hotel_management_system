<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "hotel_booking");
$rooms = $conn->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>All Rooms</h2>
    <a href="add_room.php" class="btn btn-success mb-3">Add New Room</a>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $rooms->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['room_name'] ?></td>
                <td><?= $row['room_type'] ?></td>
                <td>₹<?= $row['price'] ?></td>
                <td>
                    <?php if ($row['image']) { ?>
                        <img src="<?= $row['image'] ?>" width="80">
                    <?php } else { echo 'No image'; } ?>
                </td>
                <td>
                    <a href="edit_room.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_room.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

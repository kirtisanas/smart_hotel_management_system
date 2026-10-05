<?php
$connection = mysqli_connect("localhost", "root", "", "hotel_booking");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM bookings";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #888;
            text-align: center;
        }
    </style>
</head>
<body> 
<!-- Navigation Bar -->
<nav style="background-color: #333; padding: 10px;">
    <a href="index.html" style="color: white; margin-right: 20px; text-decoration: none;">Home</a>
    <a href="booking.html" style="color: white; margin-right: 20px; text-decoration: none;">Book Room</a>
    <a href="view_bookings.php" style="color: white; margin-right: 20px; text-decoration: none;">View Bookings</a>
</nav>

    <h2 style="text-align:center;">Booking Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Room Type</th>
            <th>Check-In</th>
            <th>Check-Out</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["room_type"]; ?></td>
            <td><?php echo $row["checkin"]; ?></td>
            <td><?php echo $row["checkout"]; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

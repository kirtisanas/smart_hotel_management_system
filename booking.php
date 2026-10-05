<?php
// Step 1: Connect to MySQL
$conn = mysqli_connect("localhost", "root", "", "hotel_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 3: Get data from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $room_type = $_POST["room_type"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];

    // Step 4: Insert into database
    $sql = "INSERT INTO bookings (name, email, room_type, checkin, checkout)
            VALUES ('$name', '$email', '$room_type', '$checkin', '$checkout')";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>✅ Booking Successful!</h2>";
        echo "<p><a href='view_bookings.php'>View All Bookings</a></p>";
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
} else {
    echo "Please submit the form from booking.html";
}

mysqli_close($conn);
?>
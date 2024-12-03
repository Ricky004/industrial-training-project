<?php
session_start();
include('connection.php');

// Check if technician is logged in
if (!isset($_SESSION['technician_id'])) {
    echo "Please login to view services.";
    exit();
}

$technician_id = $_SESSION['technician_id'];

$query = "SELECT b.book_id, u.user_name, u.phone_no, b.service_name, b.paystatus 
           FROM book b 
           JOIN user u ON b.user_id = u.user_id 
           WHERE b.technacian_id = '$technician_id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    echo "<h3>Bookings:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Booking ID</th> <th>User name</th> <th>User phone number</th> <th>Service Name</th> <th>User Status</th> <th>Actions</th></tr>";

    $bookings = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;

        echo "<tr>";
        echo "<td>" . $row['book_id'] . "</td>";
        echo "<td>" . $row['user_name'] . "</td>";
        echo "<td>" . $row['phone_no'] . "</td>";
        echo "<td>" . $row['service_name'] . "</td>";

        // Display user status
        if ($row['paystatus'] == 'confirmed') {
            echo "<td>Confirmed</td>";
        } elseif ($row['paystatus'] == 'cancelled') {
            echo "<td>Cancelled</td>";
        } else {
            echo "<td>Pending</td>";
        }

        // Add Cancel/Confirm links
        echo "<td>";

        echo "<a href='status.php?book_id=" . $row['book_id'] . "&action=cancelled&user_name=" . $row['user_name'] . "'>Cancel</a> | ";

        echo "<a href='status.php?book_id=" . $row['book_id'] . "&action=confirmed&user_name=" . $row['user_name'] . "'>Confirm</a>";
        echo "</td>";
        echo "</tr>";
    }

    // Store bookings in session
    $_SESSION['bookings'] = $bookings;

    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}

mysqli_close($conn);
?>
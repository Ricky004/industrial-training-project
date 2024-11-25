<?php
session_start();
include('connection.php');


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
} else {
    echo "User ID not provided!";
    exit();
}

if (!isset($_GET['service_id'])) {
    die("Service ID not provided!");
}

$user_id = $_SESSION['user_id']; 
$service_id = intval($_GET['service_id']);

// Retrieve service details
$query = "SELECT * FROM `all services` WHERE id = $service_id";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error retrieving service details: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $service_row = mysqli_fetch_assoc($result);
    $service_name = $service_row['service_name']; 
} else {
    die("Service not found!");
}

// Retrieve available technicians
$query = "SELECT * FROM technacian WHERE avalability = 'available'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error retrieving technicians: " . mysqli_error($conn));
}

// Check if any technicians are available
if (mysqli_num_rows($result) > 0) {
    $technician_row = mysqli_fetch_assoc($result);
    $technician_id = $technician_row['technacian_id'];

    // Check if the service is already booked for this user
    $check_query = "SELECT * FROM book WHERE user_id = $user_id AND service_id = $service_id AND paystatus = 'pending'";
    $check_result = mysqli_query($conn, $check_query);
    if (!$check_result) {
        die("Error checking booking: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check_result) > 0) {
        // Service already booked, update quantity
        $booking_row = mysqli_fetch_assoc($check_result);
        $new_quantity = $booking_row['quantity'] + 1;

        // Update the booking with the new quantity
        $update_query = "UPDATE book SET quantity = $new_quantity WHERE book_id = " . $booking_row['book_id'];
        if (mysqli_query($conn, $update_query)) {
            echo "Booking updated successfully!<br>";
            echo "Service Name: " . htmlspecialchars($service_row['service_name']) . "<br>";
            echo "Technician Assigned: " . htmlspecialchars($technician_row['name']) . "<br>";
            echo '<a href="../../service-list.php" class="btn btn-primary">Back to browse service</a>';
        } else {
            die("Error updating booking: " . mysqli_error($conn));
        }
    } else {
        // Service not booked, insert a new booking with quantity 1
        $insert_query = "INSERT INTO book (service_name, request_id, technacian_id, paystatus, service_id, user_id, quantity)
                         VALUES ('$service_name', '', '$technician_id', 'pending', '$service_id', '$user_id', 1)";
                         
        if (mysqli_query($conn, $insert_query)) {
            // Display booking confirmation
            echo "Service booked successfully!<br>";
            echo "Service Name: " . htmlspecialchars($service_row['service_name']) . "<br>";
            echo "Technician Assigned: " . htmlspecialchars($technician_row['name']) . "<br>";
            echo '<a href="../../service-list.php" class="btn btn-primary">Back to browse service</a>';
        } else {
            die("Error inserting booking: " . mysqli_error($conn));
        }
    }
} else {
    echo "Sorry, no technicians are available for this service.";
}


// Close the database connection
mysqli_close($conn);

?>
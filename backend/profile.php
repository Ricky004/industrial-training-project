<?php
session_start();
include('connection.php'); // Include your DB connection

// Check if technician_id is set in POST request
if (isset($_SESSION['technician_id'])) {
    $technician_id = $_SESSION['technician_id']; // Get the technician_id from POST
} else {
    echo "Technician ID not provided!";
    exit();
}

// Fetch the technician's profile details from the database
$query = "SELECT * FROM technician WHERE technician_id = '$technician_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $technician = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}
?>

<!-- Display the technician's profile -->
<h1>Your Profile</h1>

<p><strong>id:</strong> <?php echo $technician['technician_id']; ?></p>
<p><strong>Name:</strong> <?php echo $technician['name']; ?></p>
<p><strong>Email:</strong> <?php echo $technician['email']; ?></p>
<p><strong>Password:</strong> <?php echo $technician['password']; ?></p>
<p><strong>Phone:</strong> <?php echo $technician['phone']; ?></p>
<p><strong>Type of service:</strong> <?php echo $technician['type_of_service']; ?></p>
<p><strong>Avalability:</strong> <?php echo $technician['avalability']; ?></p>


<!-- Link to edit profile -->
<a href="edit.php">Edit Profile</a>
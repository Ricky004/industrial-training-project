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
$query = "SELECT * FROM technacian WHERE technacian_id = '$technician_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $technician = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}
?>

<!-- Display the technician's profile -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-header">
            <h1>Profile Information</h1>
            <p>View and edit your profile details below.</p>
        </div>
        <img src="../images/handyman.png" alt="profile-image">
        <div class="profile-field">
            <label>Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($technician['name']); ?>" readonly>
        </div>

        <div class="profile-row">
            <div class="profile-field">
                <label>Email Address</label>
                <input type="email" value="<?php echo htmlspecialchars($technician['email']); ?>" readonly>
            </div>
            <div class="profile-field">
                <label>Phone Number</label>
                <input type="tel" value="<?php echo htmlspecialchars($technician['phone']); ?>" readonly>
            </div>
        </div>

        <div class="profile-field">
            <label>Current Position</label>
            <input type="text" value="<?php echo htmlspecialchars($technician['address']); ?>" readonly>
        </div>
        <div class="profile-field">
            <label>Current Position</label>
            <input type="text" value="<?php echo htmlspecialchars($technician['experience']); ?>" readonly>
        </div>
        <div class="profile-field">
            <label>Current Position</label>
            <input type="text" value="<?php echo htmlspecialchars($technician['type_of_service']); ?>" readonly>
        </div>
        <a href="edit.php">
            <button class="edit">Edit</button>
        </a>
        <a href="user/logout.php">
            <button class="logout">log out</button>
        </a>
    </div>

</body>

</html>
<?php
session_start();
include('connection.php'); // Include your DB connection

// Check if user_id is set in POST request
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the user_id from POST
} else {
    echo "User ID not provided!";
    exit();
}

// Fetch the user's profile details from the database
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}
?>

<!-- User Profile Display -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
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
        <img src="../../images/profile.png" alt="profile-image">
        <div class="profile-field">
            <label>Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($user['user_name']); ?>" readonly>
        </div>

        <div class="profile-row">
            <div class="profile-field">
                <label>Email Address</label>
                <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>
            <div class="profile-field">
                <label>Phone Number</label>
                <input type="tel" value="<?php echo htmlspecialchars($user['phone_no']); ?>" readonly>
            </div>
        </div>

        <div class="profile-field">
            <label>Current Position</label>
            <input type="text" value="<?php echo htmlspecialchars($user['user_type']); ?>" readonly>
        </div>
        <a href="edit.php">
            <button class="edit">Edit</button>
        </a>
        <a href="logout.php">
            <button class="logout">log out</button>
        </a>
    </div>

</body>

</html>
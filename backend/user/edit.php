<?php
session_start();
include('connection.php'); // Include your DB connection

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the user_id from session

// Fetch the current profile data
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}

if (isset($_POST['update'])) {
    // Get the updated data from the form
    $new_name = $_POST['user_name'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Update the user profile in the database
    $update_query = "UPDATE user SET user_name = '$new_name', email = '$new_email', password = '$new_password ' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "Profile updated successfully!";
        header('Location: profile.php'); // Redirect to profile page after update
    } else {
        echo "Error updating profile!";
    }
}
?>

<!-- Edit Profile Form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;700;900&display=swap');
    </style>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h2>Edit Profile</h2>
            <form method="POST">
                <div class="input-group">
                    <label for="fullname">fullname</label>
                    <input type="text" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <label for="phone_no">Phone</label>
                    <input type="tel" name="phone_no" value="<?php echo htmlspecialchars($user['phone_no']); ?>" placeholder="Phone Number" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" placeholder="Password" required>
                </div>

                <button type="submit" name="update" class="btn">Save</button>
            </form>
        </div>
    </div>
</body>

</html>
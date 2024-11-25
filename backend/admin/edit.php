<?php
session_start();
include('connection.php'); // Include your DB connection

// Check if admin_id is set in the session
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$admin_id = $_SESSION['admin_id']; // Get the admin_id from session

// Fetch the current admin's profile data
$query = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $admin = mysqli_fetch_assoc($result);
} else {
    echo "Admin not found!";
    exit();
}

if (isset($_POST['update'])) {
    // Get the updated data from the form
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Update the admin profile in the database (ensure password is hashed)
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
    $update_query = "UPDATE admin SET email = '$new_email', password = '$new_password_hashed' WHERE admin_id = '$admin_id'"; 

    if (mysqli_query($conn, $update_query)) {
        echo "Profile updated successfully!";
        header('Location: profile.php'); // Redirect to profile page after update
    } else {
        echo "Error updating profile!";
    }
}
?>

<!-- Edit Profile Form -->
<h1>Edit Profile</h1>
<form method="POST" action="">
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $admin['email']; ?>" required><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="update" value="Update Profile">
</form>

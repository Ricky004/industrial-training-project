<?php
session_start();

include('connection.php');
// Check if admin_id is set in the session
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id']; // Get the admin_id from session
} else {
    echo "Admin ID not provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body {
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    h1 {
      color: #333;
      text-align: center;
    }
    p {
      color: #666;
      font-size: 16px;
    }
  </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Welcome, <?php 
                    // Check if 'admin_name' exists in session data
                    echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin'; 
                ?>!</h1>
            <p>Admin Dashboard</p>
        </header>

        <div class="dashboard-buttons">
            <button onclick="location.href='home.php'">Home</button>
            <button onclick="location.href='profile.php'">Profile</button>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

</body>
</html>

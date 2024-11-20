<?php
session_start();

include('connection.php');
// Check if technician_id is set in POST request
if (isset($_SESSION['technician_id'])) {
    $technician_id = $_SESSION['technician_id']; // Get the technician_id from POST
} else {
    echo "Technician ID not provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
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
                    // Check if 'name' exists in POST data
                    echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Technician'; 
                ?>!</h1>
            <p>Technician Dashboard</p>
        </header>

        <div class="dashboard-buttons">
            <button onclick="location.href='home.php'">Home</button>
            <button onclick="location.href='profile.php'">Profile</button>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

</body>
</html>

<?php
session_start();
include('connection.php'); // Include your DB connection

// Check if admin_id is set in session
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id']; // Get the admin_id from session
} else {
    echo "<script>alert('Admin ID not provided! Please log in.'); window.location.href='login.php';</script>";
    exit();
}

// Fetch the admin's profile details from the database
$query = "SELECT * FROM admin WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Admin not found!'); window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            width: 400px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
        }

        .profile-header {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            border-bottom: 2px solid #0056b3;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .profile-body {
            padding: 20px;
        }

        .profile-body p {
            margin: 10px 0;
            font-size: 16px;
        }

        .profile-body strong {
            color: #333;
        }

        .edit-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .logout-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: #FF3300;            ;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>Admin Profile</h1>
        </div>
        <div class="profile-body">
            <p><strong>Admin ID:</strong> <?php echo htmlspecialchars($admin['admin_id']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['admin_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($admin['phone']); ?></p>
            <!-- Do not display passwords -->
        </div>
        <a href="edit.php" class="edit-btn">Edit Profile</a>
        <a href="../user/logout.php" class="logout-btn">Log out</a>
    </div>
</body>
</html>

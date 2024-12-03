<?php

include('connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query to fetch technician details
    $sql = "SELECT * FROM technacian WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch technician details
        $technician = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $technician['password'])) {
            // Set session variables
            $_SESSION['technician_id'] = $technician['technacian_id'];
            $_SESSION['name'] = $technician['name'];

            // Redirect to the homepage
            header("Location: ../index.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../join-as-a-technician.css">
    <title>Technician Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
</head>
<body>
    <div class="container">
        <h1>Technician Login</h1>
        <p class="subtitle">Enter your credentials to access your account.</p>

        <form method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" name="login">Log In</button>
            <p class="register-link">Don't have an account? <a href="../join-as-a-technician.html">Register</a></p>
        </form>
    </div>
</body>
</html>

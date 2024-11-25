<?php
session_start();
include('connection.php');

if (isset($_POST['login'])) {
    // Retrieve and sanitize user inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Use a prepared statement to fetch admin details securely
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $admin['password'])) {
            // Set session variables for the admin
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['admin_name'];
            $_SESSION['email'] = $admin['email'];

            // Redirect to the dashboard
            header("Location: ../../index.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    } else {
        echo "<script>alert('No admin found with this email.');</script>";
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
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="../../style-signup.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Log in</h2>
            <form method="POST">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn">Log in</button>
            </form>
            <p class="login-link">Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
        <div class="image-box">
            <img src="../../images/login-image.jpg" alt="Login Illustration">
        </div>
    </div>
</body>
</html>

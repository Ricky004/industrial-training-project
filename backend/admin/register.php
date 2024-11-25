<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $_POST['phone'];

    // SQL query to insert data into the 'admin' table
    $sql = "INSERT INTO admin (admin_id, admin_name, email, password, phone) 
            VALUES ('$admin_id', '$admin_name', '$email', '$password', '$phone')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php"); // Redirect to login page on success
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn); // Show error message if query fails
    }
}

mysqli_close($conn); // Close the database connection
?>

<html>

<head>
    <title>Admin signup page</title>
    <link rel="stylesheet" href="../../style-signup.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Create an Account</h2>
            <!-- Connect to process.php -->
            <form method="POST" onsubmit="validatePasswords(event)">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="admin_name" placeholder="Full Name" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <select class="country-code" name="country_code">
                        <option value="+91">+91</option>
                    </select>
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn">Sign Up</button>
            </form>
            <p id="error-message" style="color: red; text-align: center; display: none;">Passwords do not match</p>
            <p class="login-link">Already have an account? <a href="login.php">Log in</a></p>
        </div>
        <div class="image-box">
            <img src="../../images/login-image.jpg" alt="Signup Illustration">
        </div>
    </div>

    <script>
        function validatePasswords(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const errorMessage = document.getElementById('error-message');

            if (password !== confirmPassword) {
                event.preventDefault();
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        }
    </script>

</body>

</html>
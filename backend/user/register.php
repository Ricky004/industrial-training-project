<?php
// Include the connection file
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form inputs
    $username = htmlspecialchars($_POST['user_name']);
    $email = htmlspecialchars($_POST['email']);
    $phn = htmlspecialchars($_POST['phone_no']);
    $password = htmlspecialchars($_POST['password']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL query to insert user data
    $sql = "INSERT INTO user (user_name, email, phone_no, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    if ($stmt) {
        $stmt->bind_param("ssss", $username, $email, $phn, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: ../../index.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

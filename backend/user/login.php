<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the form inputs
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Prepare the SQL query to check if the user exists
    $sql = "SELECT user_id, user_name, password FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the email parameter
        $stmt->bind_param("s", $email);

        // Execute the query
        $stmt->execute();

        // Store the result
        $stmt->store_result();

        // Check if a user with the entered email exists
        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($id, $username, $hashed_password);

            // Fetch the result
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $username;
                $_SESSION['email'] = $email;

                // Redirect to the home page (index.php)
                header("Location: ../../index.php");
                exit();
            } else {
                // Invalid password
                echo "Incorrect password!";
            }
        } else {
            // No user found with that email
            echo "No user found with that email!";
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

<?php

include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $_POST['phone'];
    $type_of_service = $_POST['typeofservice'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $terms_condition = $_POST['terms'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO technacian (name, email, password, address, experience, phone, type_of_service, terms_condition) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisss", $name, $email, $password, $address, $experience, $phone, $type_of_service, $terms_condition);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        // Display an error message
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
?>

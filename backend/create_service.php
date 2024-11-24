<?php

include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $service_name = $conn->real_escape_string($_POST['service_name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    // Insert data into the services table
    $sql = "INSERT INTO `all services` (service_name, price, description) 
            VALUES ('$service_name', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../service-list.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

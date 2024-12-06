<?php

include "connection.php";

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['technician_id'])) {
        die("Technician not logged in.");
    }

    // Retrieve form data
    $service_name = $conn->real_escape_string($_POST['service_name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    $technacian_id = $_SESSION['technician_id'];


    // Insert data into the services table
    $sql = "INSERT INTO `all services` (service_name, price, description, technacian_id) 
            VALUES ('$service_name', '$price', '$description', $technacian_id)";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../service-list.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

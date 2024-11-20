<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['technician_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $_POST['phone'];
    $type_of_service = $_POST['type_of_service'];

    $sql = "INSERT INTO technician (technician_id, name, email, password, phone, type_of_service) VALUES ('$id','$name', '$email', '$password', '$phone', '$type_of_service')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . 

mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


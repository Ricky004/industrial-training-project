<?php

include "backend/connection.php";

session_start();
if (!isset($_SESSION['technician_id'])) {
    header("Location: login.php");
    exit();
}

$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM `all services` WHERE id = $service_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $service = $result->fetch_assoc();
} else {
    die("Service not found.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $conn->real_escape_string($_POST['service_name']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    $update_sql = "UPDATE `all services` SET 
                   service_name = '$service_name', 
                   price = '$price', 
                   description = '$description' 
                   WHERE id = $service_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Service updated successfully!";
        header("Location: service-list.php");
        exit();
    } else {
        echo "Error updating service: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create-service.css">
    <title>Edit Service</title>
</head>

<body>
    <div class="container">
        <h1>Edit Service</h1>
        <form method="POST" id="serviceForm">

            <label for="serviceName">Service Name:</label>
            <input type="text" id="serviceName" name="service_name" value="<?php echo htmlspecialchars($service['service_name']); ?>" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($service['price']); ?>" step="0.01" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($service['description']); ?></textarea>

            <button type="submit">Update Service</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>
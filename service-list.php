<?php
include "backend/connection.php";

session_start();

// Check if the logged-in user is a technician
$isTechnician = isset($_SESSION['technician_id']);

// Check if the logged-in user is a customer (user)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$sql = "SELECT id, service_name, price, description FROM `all services`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="service-list.css">
    <title>Service List</title>
</head>
<body>
    <div class="container">
        <div class="packages">
            <h1>Available Services</h1>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $service_id = htmlspecialchars($row['id']);
                    $service_name = htmlspecialchars($row['service_name']);
                    $price = htmlspecialchars($row['price']);
                    $description = htmlspecialchars($row['description']);

                    echo "
                    <div class='package-card'>
                        <span class='package-tag'>SERVICE</span>
                        <div class='package-header'>
                            <div>
                                <h2 class='package-title'>$service_name</h2>
                                <div class='rating'>4.8★ (1.5k reviews)</div>
                                <div class='price-time'>
                                    <span class='price'>₹$price</span>
                                    <span class='time'>• 1 hr</span>
                                </div>
                            </div>
                            <form action='backend/user/book_service.php' method='GET'>
                                <input type='hidden' name='service_id' value='$service_id'>
                                <input type='hidden' name='service_name' value='$service_name'>
                                <input type='hidden' name='price' value='$price'>
                                <button class='add-btn' type='submit'>Add to Cart</button>
                            </form>
                        </div>
                        <ul class='services'>
                            <li><strong>Description:</strong> $description</li>
                        </ul>";

                    // Technician can edit service
                    if ($isTechnician) {
                        echo "
                        <a href='edit-service.php?id=$service_id'>
                            <button class='edit-btn'>Edit Service</button>
                        </a>";
                    }

                    echo "</div>";
                }
            } else {
                echo "<p>No services available.</p>";
            }
            ?>

        </div>

        <div class="sidebar">
            <?php
            // Show cart section only if the user is logged in
            if ($user_id) {
                echo "<div class='cart-section'>
                    <h3>Your Cart</h3>";

                // Query to display items in the cart for the logged-in user
                $cart_sql = "SELECT service_name, paystatus, quantity FROM book WHERE user_id = $user_id";
                $cart_result = $conn->query($cart_sql);

                if ($cart_result->num_rows > 0) {
                    echo "<ul>";
                    while ($cart_row = $cart_result->fetch_assoc()) {
                        $cart_service_name = htmlspecialchars($cart_row['service_name']);
                        $cart_price = htmlspecialchars($cart_row['paystatus']);
                        $cart_quantity = htmlspecialchars($cart_row['quantity']);

                        echo "
                        <li class='cart-item'>
                            <strong class='service-name'>$cart_service_name</strong> - <span class='price'>₹$cart_price</span> (<span class='quantity'>x$cart_quantity</span>)
                        </li>
                        ";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No items in your cart.</p>";
                }

                echo "</div>";
            }
            ?>

            <div class="rewards-section">
                <div class="reward-header">
                    <span class="reward-icon">%</span>
                    <h3>Exclusive Benefits for Choosing Our Technicians</h3>
                </div>
                <p style="color: #666; font-size: 14px;">Exclusive Rewards with Every Service (Payment Options Coming Soon)</p>
            </div>

            <div class="promise-section">
                <h3>Our Service Promise</h3>
                <ul class="promise-list">
                    <li>Skilled and Experienced Technicians</li>
                    <li>High-Quality Service Standards</li>
                    <li>Competitive and Transparent Pricing</li>
                </ul>
            </div>

        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>

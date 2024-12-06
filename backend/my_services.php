<?php
session_start();
include('connection.php');

// Check if technician is logged in
if (!isset($_SESSION['technician_id'])) {
    echo "<div class='message'>Please login to view services.</div>";
    exit();
}

$technician_id = $_SESSION['technician_id'];

$query = "SELECT b.book_id, u.user_name, u.phone_no, b.service_name, b.paystatus 
          FROM book b 
          JOIN user u ON b.user_id = u.user_id 
          WHERE b.technacian_id = '$technician_id'";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .message {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if (!$result) {
        echo "<div class='message'>Query Failed: " . mysqli_error($conn) . "</div>";
    } elseif (mysqli_num_rows($result) > 0) {
        echo "<h3>Your Bookings</h3>";
        echo "<table>";
        echo "<tr>
                <th>Booking ID</th>
                <th>User Name</th>
                <th>Phone Number</th>
                <th>Service Name</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>";

        $bookings = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;

            echo "<tr>";
            echo "<td>" . $row['book_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['phone_no'] . "</td>";
            echo "<td>" . $row['service_name'] . "</td>";

            // Display user status
            $status = $row['paystatus'];
            echo "<td>";
            if ($status == 'confirmed') {
                echo "<span style='color: green;'>Confirmed</span>";
            } elseif ($status == 'cancelled') {
                echo "<span style='color: red;'>Cancelled</span>";
            } else {
                echo "<span style='color: orange;'>Pending</span>";
            }
            echo "</td>";

            // Add action links
            echo "<td>
                    <a href='status.php?book_id=" . $row['book_id'] . "&action=cancelled'>Cancel</a> | 
                    <a href='status.php?book_id=" . $row['book_id'] . "&action=confirmed'>Confirm</a>
                  </td>";
            echo "</tr>";
        }

        // Store bookings in session
        $_SESSION['bookings'] = $bookings;

        echo "</table>";
    } else {
        echo "<div class='message'>No bookings found.</div>";
    }

    mysqli_close($conn);
    ?>
</div>
</body>
</html>

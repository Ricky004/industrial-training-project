<?php
session_start();
include 'connection.php'; 


if (isset($_GET['book_id']) && isset($_GET['action'])) {
    $book_id = $_GET['book_id'];
    $action = $_GET['action'];
    $user_name = $_GET['user_name'];


    echo "Book ID: $book_id<br>";
    echo "User Name: $user_name<br>";
    echo "Action: $action<br>";

    // Process based on the action
    if ($action === 'confirmed') {
        $query = "UPDATE book SET technician_status='confirmed' WHERE book_id='$book_id'";
    } elseif ($action === 'cancelled') {
        $query = "UPDATE book SET technician_status='cancelled' WHERE book_id='$book_id'";
    } else {
        echo "Invalid action.";
        exit;
    }

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "You $action'ed service for $user_name successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Book ID, user name, or action not provided.";
}

echo ' go back to home </a>';
?>
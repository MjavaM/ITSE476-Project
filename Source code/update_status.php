<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include database connection file
include 'include/db_conn.php';

// Check if orderId and status are set and not empty
if (isset($_POST['orderId']) && isset($_POST['status']) && !empty($_POST['orderId']) && !empty($_POST['status'])) {
    // Sanitize input
    $orderId = mysqli_real_escape_string($conn, $_POST['orderId']);
    $status  = mysqli_real_escape_string($conn, $_POST['status']);

    // Update status in the database
    $updateSql = "UPDATE `order` SET `status` = '$status' WHERE id = {$orderId}";
    if ($conn->query($updateSql) === TRUE) {
        // Status updated successfully
        echo 'Status updated successfully for order ' . $orderId;
    } else {
        // Error updating status
        echo 'Error updating status for order ' . $orderId . ': ' . $conn->error;
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
?>

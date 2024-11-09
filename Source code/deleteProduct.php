<?php
require_once('include/db_conn.php');

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    // Prepare and execute the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        // Product deleted successfully
        header("Location: indexp.php"); // Redirect to the product listing page
        exit();
    } else {
        // Error occurred while deleting the product
        die('Error deleting product: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    
} else {
    die('Product ID is missing.');
}
?>

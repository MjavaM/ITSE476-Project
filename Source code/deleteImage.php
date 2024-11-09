<?php
// Include database connection file
include 'include/db_conn.php';

// Get the product ID and image URL from the request
$product_id = $_POST['product_id'];
$imageUrl = $_POST['data_image'];

// Construct the file path by extracting the filename from the URL
$filename = basename($imageUrl);
$baseDir = 'image/'; // Base directory where images are stored
$filePath = $baseDir . $filename;

// Fetch existing image URLs for the product from the database
$sql = "SELECT images FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $images = explode(',', $row['images']);
    
    // Remove the image URL from the array
    $images = array_diff($images, array($imageUrl));
    
    // Update the images column in the database
    $images_str = implode(',', $images);
    $update_sql = "UPDATE products SET images = '$images_str' WHERE id = $product_id";
    if ($conn->query($update_sql) === TRUE) {
        // Delete the image file from the folder
        if (unlink($filePath)) {
            // Image deleted successfully from the folder
            http_response_code(200); // OK
        } else {
            // Error deleting image from the folder
            http_response_code(500); // Internal Server Error
        }
    } else {
        // Error updating database
        http_response_code(500); // Internal Server Error
    }
} else {
    // Product not found
    http_response_code(404); // Not Found
}

$conn->close();
?>

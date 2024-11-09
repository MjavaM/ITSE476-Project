<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('include/db_conn.php');
include('header/header.php');

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addProduct'])) {
    $categories = htmlspecialchars($_POST['categories']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_qty = (int) $_POST['product_qty'];
    $product_price = (float) $_POST['product_price'];
    $product_code = htmlspecialchars($_POST['product_code']);
    $short_desc = htmlspecialchars($_POST['short_desc']);
    $product_image = '';

    // Handle image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image = $_FILES['product_image'];
        $random_number = rand(1000, 9999);
        $image_name = uniqid() . '-' . $random_number . '-' . basename($image['name']);
        $target_path = "image/" . $image_name;

        if (move_uploaded_file($image['tmp_name'], $target_path)) {
            $product_image = $target_path;
        } else {
            echo "<script>alert('Failed to upload image: " . $image['name'] . "');</script>";
            exit;
        }
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO product (categories, product_name, product_qty, product_price, product_image, product_code, short_desc) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("ssissss", $categories, $product_name, $product_qty, $product_price, $product_image, $product_code, $short_desc);
    if ($bind === false) {
        die('Bind failed: ' . htmlspecialchars($stmt->error));
    }

    // Execute the SQL statement
    if ($stmt->execute() === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    echo "<script>alert('Product added successfully');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="addProduct.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="welcome.php" class="logo">Product Management System</a>
            <ul class="nav-links">
                <li><a href="indexp.php">Products</a></li>
                <li><a href="orders.php">Orders</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Add Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="categories">Categories:</label>
            <input type="text" id="categories" name="categories" required><br><br>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required><br><br>

            <label for="product_qty">Quantity:</label>
            <input type="number" id="product_qty" name="product_qty" min="1" required><br><br>

            <label for="product_price">Price:</label>
            <input type="number" id="product_price" name="product_price" min="0.01" step="0.01" required><br><br>

            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" required><br><br>

            <label for="product_code">Product Code:</label>
            <input type="text" id="product_code" name="product_code" required><br><br>

            <label for="short_desc">Short Description:</label><br>
            <textarea id="short_desc" name="short_desc" rows="4" cols="50" ></textarea><br><br>

            <input type="submit" name="addProduct" value="Add">
        </form>
    </div>
</body>

</html>

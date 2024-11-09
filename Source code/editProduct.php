<?php
require_once('include/db_conn.php');

$product_id = '';
$categories = '';
$product_name = '';
$product_qty = '';
$product_price = '';
$product_code = '';
$short_desc = '';
$product_image = '';

// Fetch existing product data
if (isset($_GET['id'])) 
{
    $product_id = (int) $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Assign fetched data to variables
        $categories = htmlspecialchars($product['categories']);
        $product_name = htmlspecialchars($product['product_name']);
        $product_qty = (int) $product['product_qty'];
        $product_price = (float) $product['product_price'];
        $product_code = htmlspecialchars($product['product_code']);
        $short_desc = htmlspecialchars($product['short_desc']);
        $product_image = htmlspecialchars($product['product_image']);
    } else {
        die('Product not found.');
    }

    $stmt->close();
}

// Form submission for updating product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProduct'])) {
    $product_id = (int) $_POST['product_id'];
    $categories = htmlspecialchars($_POST['categories']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_qty = (int) $_POST['product_qty'];
    $product_price = (float) $_POST['product_price'];
    $product_code = htmlspecialchars($_POST['product_code']);
    $short_desc = htmlspecialchars($_POST['short_desc']);
    $product_image = $product['product_image']; // Use existing image by default

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
    $stmt = $conn->prepare("UPDATE product SET categories = ?, product_name = ?, product_qty = ?, product_price = ?, product_image = ?, product_code = ?, short_desc = ? WHERE product_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $bind = $stmt->bind_param("ssissssi", $categories, $product_name, $product_qty, $product_price, $product_image, $product_code, $short_desc, $product_id);
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

    echo "<script>alert('Product updated successfully');</script>";
    echo "<script>window.location.href = 'indexp.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="editProduct.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">Product Management System</a>
            <ul class="nav-links">
                <li><a href="indexp.php">Products</a></li>
                <li><a href="orders.php">Orders</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Update Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            
            <label for="categories">Categories:</label>
            <input type="text" id="categories" name="categories" value="<?php echo $categories; ?>" required><br><br>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" required><br><br>

            <label for="product_qty">Quantity:</label>
            <input type="number" id="product_qty" name="product_qty" min="1" value="<?php echo $product_qty; ?>" required><br><br>

            <label for="product_price">Price:</label>
            <input type="number" id="product_price" name="product_price" min="0.01" step="0.01" value="<?php echo $product_price; ?>" required><br><br>

            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image"><br>
            <img src="<?php echo $product_image; ?>" alt="Product Image" width="100"><br><br>

            <label for="product_code">Product Code:</label>
            <input type="text" id="product_code" name="product_code" value="<?php echo $product_code; ?>" required><br><br>

            <label for="short_desc">Short Description:</label><br>
            <textarea id="short_desc" name="short_desc" rows="4" cols="50" ><?php echo $short_desc; ?></textarea><br><br>

            <input type="submit" name="updateProduct" value="Update">
        </form>
    </div>
</body>

</html>

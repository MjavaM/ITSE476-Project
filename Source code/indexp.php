<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Products</title>
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
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>View Products</h2>
        <a href="addProduct.php" style="text-decoration: none;" class="btn btn-add-product">Add Product</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Categories</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Product Code</th>
                    <th>Short Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection file
                include 'include/db_conn.php';

                // Fetch data from database
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["categories"] . "</td>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["product_qty"] . "</td>";
                        echo "<td>" . $row["product_price"] . "</td>";
                        echo "<td><img src='" . $row["product_image"] . "' alt='" . $row["product_name"] . "' style='width:50px;height:auto;'/></td>";
                        echo "<td>" . $row["product_code"] . "</td>";
                        echo "<td>" . $row["short_desc"] . "</td>";
                        echo "<td>
                                <a href='editProduct.php?id=" . $row["product_id"] . "' class='btn btn-edit' style='margin-right:2px;text-decoration:none'>Edit</a>
                                <a href='deleteProduct.php?id=" . $row["product_id"] . "' class='btn btn-delete' style='text-decoration:none'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } 
                else {
                    echo "<tr><td colspan='8'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


</body>

</html>
<?php
// Include database connection file
include 'include/db_conn.php';
include 'header/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="orders.css">
    <title>View Orders</title>
    <style>
        /* Bootstrap 5 select style */
        .dropdown select {
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            vertical-align: middle;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            cursor: pointer;
        }

        /* Custom colors */

        /* Custom colors */
        .dropdown select.pending {
            color: #dc3545;
        }

        .dropdown select.processing {
            color: #007bff;
        }

        .dropdown select.delivered {
            color: #28a745;
        }

        /* Style dropdown options */
        .dropdown select option.pending {
            background-color: #ffc7c7;
        }

        .dropdown select option.processing {
            background-color: #c7e0ff;
        }

        .dropdown select option.delivered {
            background-color: #c7ffc7;
        }
    </style>
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
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Include database connection file
                include 'include/db_conn.php';

                // Fetch data from orders table
                $sql = "SELECT * FROM `order`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each order
                    while ($row = $result->fetch_assoc()) {
                        // Fetch product title from products table based on product_id
                        $product_id = $row["product_id"];
                        $product_sql = "SELECT product_name FROM product WHERE product_id = $product_id";
                        $product_result = $conn->query($product_sql);
                        $product_title = ($product_result->num_rows > 0) ? $product_result->fetch_assoc()["product_name"] : "Product Not Found";

                        // Determine button color based on status
                        $status = $row["status"];
                        $button_color = '';
                        switch ($status) {
                            case 'pending':
                                $button_color = 'pending';
                                break;
                            case 'delivered':
                                $button_color = 'delivered';
                                break;
                            case 'processing':
                                $button_color = 'processing';
                                break;
                            default:
                                $button_color = '';
                                break;
                        }
                        // Construct dropdown menu with appropriate status selected
                        echo "<tr>";
                        echo "<td>" . $row["user_name"] . "</td>";
                        echo "<td>" . $product_title . "</td>";
                        echo "<td>" . $row["Qunty"] . "</td>";
                        echo "<td>$" . $row["total_price"] . "</td>"; // Assuming price is in USD
                        echo "<td class='dropdown'>";
                        echo "<select class='btn-status $button_color' data-order-id='" . $row["id"] . "'>";
                        echo "<option value='pending' class='pending' " . ($status == 'pending' ? 'selected' : '') . ">Pending</option>";
                        echo "<option value='processing' class='processing' " . ($status == 'processing' ? 'selected' : '') . ">Processing</option>";
                        echo "<option value='delivered' class='delivered' " . ($status == 'delivered' ? 'selected' : '') . ">Delivered</option>";
                        echo "</select>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to dropdown select elements
            var dropdowns = document.querySelectorAll('.dropdown select');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('change', function() {
                    var orderId = this.getAttribute('data-order-id');
                    var status = this.value;

                    // Send AJAX request to update status
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Status updated successfully
                                console.log('Status updated for order ' + orderId);
                                // Reload the page
                                location.reload();
                            } else {
                                // Error updating status
                                console.error('Error updating status for order ' + orderId);
                            }
                        }
                    };
                    xhr.open('POST', 'update_status.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('orderId=' + orderId + '&status=' + status);
                });
            });
        });
    </script>
</body>

</html>
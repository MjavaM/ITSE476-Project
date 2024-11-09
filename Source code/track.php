<?php
require_once 'include/db_conn.php';
require_once 'header/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="track.css">
</head>
<body>   
     <main>
        <div class="cart1">
        <h1>Orders List</h1>
        <?php 

        $sql = "SELECT * FROM `order`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
            <div class="order">
                <h2>User ID: <?= htmlspecialchars($row['ID User']) ?></h2>
                <h2>Order ID: <?= htmlspecialchars($row['id']) ?></h2>
                <h2>Product ID: <?= htmlspecialchars($row['product_id']) ?></h2>
                <h2>Quantity: <?= htmlspecialchars($row['Qunty']) ?></h2>
                <h2>Total Price: $<?= htmlspecialchars($row['total_price']) ?></h2>
                <h2>st: $<?= htmlspecialchars($row['total_price']) ?></h2>

            </div>
        <?php
            }
        } else {
            echo "<p>No orders found.</p>";
        }
        $stmt->close();
        ?>
        </div>

        <div class="cart2">
        <h1>Cart List</h1>

            <?php 
            $sql = "SELECT * FROM `cart`";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="order">
                    <h2>User ID: <?= htmlspecialchars($row['ID User']) ?></h2>
                    <h2>Order ID: <?= htmlspecialchars($row['id']) ?></h2>
                    <h2>Product Name: <?= htmlspecialchars($row['product_name']) ?></h2>
                    <h2>Quantity: <?= htmlspecialchars($row['qty']) ?></h2>
                    <h2>Total Price: $<?= htmlspecialchars($row['total_price']) ?></h2>
                </div>
            <?php
                }
            } else {
                echo "<p>No items in cart.</p>";
            }
            $stmt->close();
            ?>
        </div>
    </main>
</body>
</html>

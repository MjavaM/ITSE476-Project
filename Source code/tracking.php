<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <link rel="stylesheet" href="tracking.css">
</head>
<body>

<?php
include("header/header.php");
//Connect to the database
$host = 'localhost';
$dbname = 'project';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// retrieve order status
function getOrders($user_id, $conn) {
    $stmt = $conn->prepare("SELECT * FROM `order` WHERE `ID User` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// retrieve previous orders
function getPreviousOrders($user_id, $conn) {
    $stmt = $conn->prepare("SELECT * FROM `order` WHERE `ID User` = ? AND `status` = 'completed'");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// update order status
function updateOrderStatus($order_id, $status, $conn) {
    $stmt = $conn->prepare("UPDATE `order` SET `status` = ? WHERE `ID` = ?");
    $stmt->bind_param("si", $status, $order_id);
    return $stmt->execute();
}

// retrieve the order data for user ID 1
$user_id = 1;
$orders = getOrders($user_id, $conn);
$previous_orders = getPreviousOrders($user_id, $conn);
?><h2>current orders</h2><?php
// display current orders
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Product ID</th>';
echo '<th>Quantity</th>';
echo '<th>Total Price</th>';
echo '<th>Status</th>';
echo '<th>Created At</th>';
echo '<th>Updated At</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($orders as $order) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($order['id']) . '</td>';
    echo '<td>' . htmlspecialchars($order['product_id']) . '</td>';
    echo '<td>' . htmlspecialchars($order['Qunty']) . '</td>';
    echo '<td>' . htmlspecialchars($order['total_price']) . '</td>';
    echo '<td>' . htmlspecialchars($order['status']) . '</td>';
    echo '<td>' . htmlspecialchars($order['created_at']) . '</td>';
    echo '<td>' . htmlspecialchars($order['updated_at']) . '</td>';
    echo '</tr>';

}
echo '</tbody>';
echo '</table>';

?> <br><br><br>
<h2>previous orders</h2>
<?php

// display previous orders
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Product ID</th>';
echo '<th>Quantity</th>';
echo '<th>Total Price</th>';
echo '<th>Status</th>';
echo '<th>Created At</th>';
echo '<th>Updated At</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($previous_orders as $order) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($order['id']) . '</td>';
    echo '<td>' . htmlspecialchars($order['product_id']) . '</td>';
    echo '<td>' . htmlspecialchars($order['Qunty']) . '</td>';
    echo '<td>' . htmlspecialchars($order['total_price']) . '</td>';
    echo '<td>' . htmlspecialchars($order['status']) . '</td>';
    echo '<td>' . htmlspecialchars($order['created_at']) . '</td>';
    echo '<td>' . htmlspecialchars($order['updated_at']) . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

// handle the form submission to update the order status
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    updateOrderStatus($order_id, $status, $conn);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// close the database connection
$conn->close();

?>

</body>
</html>
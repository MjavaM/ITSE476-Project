<?php
session_start();
require 'include/db_conn.php';

// Check if user is logged in
if (!isset($_SESSION['ID User'])) {
    die('User not logged in');
}

// Add products into the cart table
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = $_POST['pqty'];
    $iduser = $_SESSION['ID User'];
    $total_price = $pprice * $pqty;

    $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=? AND `ID User`=?');
    $stmt->bind_param('si', $pcode, $iduser);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['product_code'] ?? '';

    if (!$code) {
        $query = $conn->prepare('INSERT INTO cart (product_name, product_price, product_image, qty, total_price, product_code, `ID User`) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->bind_param('sssissi', $pname, $pprice, $pimage, $pqty, $total_price, $pcode, $iduser);
        $query->execute();

        echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item added to your cart!</strong>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item already added to your cart!</strong>
              </div>';
    }
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    $iduser = $_SESSION['ID User'];

    $stmt = $conn->prepare('SELECT * FROM cart WHERE `ID User`=?');
    $stmt->bind_param('i', $iduser);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $iduser = $_SESSION['ID User'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE id=? AND `ID User`=?');
    $stmt->bind_param('ii', $id, $iduser);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $iduser = $_SESSION['ID User'];

    $stmt = $conn->prepare('DELETE FROM cart ' );
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Items removed from the cart!';
    header('location:cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];
    $iduser = $_SESSION['ID User'];

    $tprice = $qty * $pprice;

    $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=? AND `ID User`=?');
    $stmt->bind_param('isii', $qty, $tprice, $pid, $iduser);
    $stmt->execute();
}
// Checkout and save customer info in the orders table
// Checkout and save customer info in the orders table
if (isset($_POST['action']) && $_POST['action'] == 'orders') {
    // Retrieve customer information from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];
    $products = ''; // Initialize variable to store purchased products
    $grand_total = 0; // Initialize variable to store grand total

    // Retrieve cart items from the session or database
    if (!empty($_SESSION['cart'])) {
        // Iterate through cart items
        foreach ($_SESSION['cart'] as $item) {
            $products .= $item['product_name'] . ', '; // Concatenate product names
            $grand_total += ($item['product_price'] * $item['quantity']); // Calculate grand total
        }
        $products = rtrim($products, ', '); // Remove trailing comma and space
    }

    // Insert customer information into orders table
    $stmt = $conn->prepare('INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('ssssssd', $name, $email, $phone, $address, $pmode, $products, $grand_total);
    $stmt->execute();

    // Clear the cart after placing the order
    unset($_SESSION['cart']);

}

?>

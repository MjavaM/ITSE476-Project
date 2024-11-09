<?php
session_start();

if (isset($_GET['key'])) {
    $key = $_GET['key'];
    unset($_SESSION['cart'][$key]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
}

header("Location: cart_view.php");
exit();
?>

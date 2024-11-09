<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="process_order.css">
</head>
<body>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $payment_method = $_POST["payment_method"];

    // Further processing logic (e.g., saving to database, sending confirmation email) can be added here
    
    // For demonstration, let's just display the received data
    echo "<h2>Order Details</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Payment Method:</strong> $payment_method</p>";
} else {
    // Redirect back to checkout page if form is not submitted
    header("Location: checkout.php");
    exit;
}
?>

</body>
</html>
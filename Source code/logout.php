<?php
session_start();

// Destroy the session to log out the user
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="logout.css">
</head>
<body>
    <div id="logout-container">
        <h1>You have been logged out</h1>
        <p>Thank you for visiting. You have successfully logged out.</p>
        <a href="login.php">Login again</a>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>

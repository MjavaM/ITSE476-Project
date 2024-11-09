<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
<?php
session_start();
require 'include/db_conn.php';

if (isset($_POST['user_name']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['user_name']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: index.php?error=Both User Name and Password are required");
        exit();
    }

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE user_name=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Set session variables
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['ID User'] = $row['ID User'];
        

        // Redirect based on user type
        switch ($row['user_type']) {
            case 'user':
                header("Location: welcome.php?type=1");
                exit();
            case 'admin':
                header("Location: welcome.php?type=2");
                exit();
            default:
                header("Location: welcome.php?type=3");
                exit();
        }
    } else {
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>


</body>
</html>
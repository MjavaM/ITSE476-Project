<?php 
require 'include/db_conn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
            <label>Username: </label>
            <input type="text" id="user" name="user_name"><br><br>
            <label>Password: </label>
            <input type="password" id="pass" name="password"><br><br>
            <input type="submit" id="btn" value="Login" name="submit">
            <a href="signup.php">Sign up</a>
        </form>
    </div>
</body>
</html>

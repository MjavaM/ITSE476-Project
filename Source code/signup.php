<?php
include("include/db_conn.php");
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
    

    $email_pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    $sql = "SELECT * FROM users WHERE user_name='$username'";
    $result = mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if ($count_user == 0 && $count_email == 0) {
        if ($password == $cpassword) {
            if (preg_match($email_pattern, $email)) {
                if (preg_match($password_pattern, $password)) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (user_name, email, password) VALUES('$username', '$email','$hash')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "Registration successful. You can now log in.";
                    } else {
                        echo "Registration failed. Please try again later.";
                    }
                } else {
                    echo "Invalid password format. Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one digit, and one special character.";
                }
            } else {
                echo "Invalid email format.";
            }
        } else {
            echo "Passwords do not match.";
        }
    } else {
        if ($count_user > 0) {
            echo "Username already exists.";
        }
        if ($count_email > 0) {
            echo "Email already exists.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="signup.css">


</head>
  <body>
      <div id="form">
            <h1 id="heading">SignUp Form</h1><br>
            <form name="form" action="signup.php" method="POST">

                <i class="fa fa-user fa-lg"></i>
                <input type="text" id="user" name="user"  placeholder="Enter Username" required></br></br>

                <i class="fa-solid fa-envelope fa-lg"></i>
                <input type="email" id="email" name="email"  placeholder="Enter Email" required></br></br>

                <i class="fa-solid fa-lock fa-lg"></i>
                <input type="password" id="pass" name="pass" placeholder="Create Password" required></br></br>

                <i class="fa-solid fa-lock fa-lg"></i>
                <input type="password" id="cpass" name="cpass"placeholder="Retype Password" required></br></br>
                
                <input type="submit" id="btn" value="SignUp" name = "submit"/>
                <a href="index.php">log in</a>

            </form>
      </div>
  </body>
</html>
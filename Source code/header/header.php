<?php
include("include/db_conn.php");
session_start(); // Start the session at the beginning

// Get the user type from the URL or POST request, and sanitize the input
$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : (isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
<header>
   

        <?php
        
          $select_product = mysqli_query($conn, 'SELECT * FROM cart') or die('query failed');
          $row_count = mysqli_num_rows($select_product);

          


        if ($type == "1"){
            ?> 
            <div class="nav">
           <div class="img">
            <a href="welcome.php?type=1"><img src="image/logo2.jpg" alt="Logo"></a>
           </div>
            <?php
                $id_user = isset($_GET['ID User']) ? htmlspecialchars($_GET['ID User']) : '';
                echo '
                <nav>
                    <ul>
                        <li><a href="tracking.php?type=1">Tracking</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="search.php?type=1">Search</a></li>
                    </ul>
                </nav>';

                ?>
              <div class="cart">
                <a href="cart.php?type=1"><i class="fa-solid fa-cart-shopping" style="color: #c0c8c6;"><span><sup><?php echo $row_count ?></sup></span></i></a>
                </div>
                </div>
               <?php 
              
        }
        
            elseif ($type == '2'){
                ?> 
                <div class="nav">
                <div class="img">
                <a href="welcome.php?type=2"><img src="image/LOGO.jpg" alt="Logo"></a>
               </div>
                <?php
                echo '
                <nav>
                    <ul>
                        <li><a href="staffsig.php?type=2">Add Staff</a></li>
                    </ul>
                </nav>';

               ?> </div><?php
                
            }


             elseif ($type=='3') {   
                ?>
                <div class="nav">

                <div class="img">
                <a href="welcome.php?type=3"><img src="image/LOGO.jpg" alt="Logo"></a>
               </div>
                <?php 
             echo '
                <nav>
                    <ul>
                        <li><a href="addProduct.php?type=3">Add Product</a></li>
                        <li><a href="editProduct.php?type=3">Edit Product</a></li>
                        <li><a href="track.php?type=3">Order Activity</a></li>
                        <li><a href="update_ststus?type=3">order status</a></li>


                    </ul>
                </nav>';
                ?></div><?php
             }



              else{ 
                ?> 
                <div class="nav">
                <div class="img">
                <a href="welcome.php"><img src="image/LOGO.jpg" alt="Logo"></a>
               </div>
                <?php         
                echo '
                <nav>
                    <ul>
                        <li><a href="login.php">Login</a></li>


                    </ul>
                </nav>';
                ?></div><?php

            
            }
        ?>

</header>
</body>
</html>

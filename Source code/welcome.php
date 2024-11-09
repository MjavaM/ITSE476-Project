<?php

include 'include/db_conn.php';
$type = isset($_GET['type']) ? $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : '');

include 'header/header.php';




  $sql = " SELECT * FROM `product`";
  $all_product = $conn->query($sql);
  
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="welcome.css">
</head>

<body>
<p>Categories</p><br><br>
   <main>
 
   
              <div class="card1">
                <a name="cart1" href="categry.php?val=1">
                    <i></i>
                    <h1>Fruit</h1>
                  
                </a>
            
          </div>

          <div class="card2">
              
                <a name="cart2" href="categry.php?val=2">
                    <i></i>
                    <h1>drinks</h1>
                </a>
       
          </div>

          <div class="card3">
           
                <a href="categry.php?val=3" >
                    <h1>egg and dairy</h1>
                </a>
               
          </div>

          <div class="card4">

                <a href="categry.php?val=4">
                    <h1>vegetable</h1>
                </a>

          </div>

          <div class="card5">

                <a href="categry.php?val=5">
                    <h1>sweet</h1>
                </a>
          
          </div>


          <div class="card6">
              
                <a href="categry.php?val=6">
                    <h1>pet</h1>
                </a>
          
          </div>

         

   
   </main>


</body>
</html>
<?php 
include 'include/db_conn.php';

?>




<head>
<meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <link rel="stylesheet" href="categry.css">
  <link rel="stylesheet" href="header/header.css">
 

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>

<body>

  <header>
  <?php
        
        $select_product = mysqli_query($conn, 'SELECT * FROM cart') or die('query failed');
        $row_count = mysqli_num_rows($select_product);


      
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
            
  

?>

  </header>
<div id="message"></div>

  <div class="container">
  <?php
    $val = $_GET["val"];

    // Retrieve products based on the value of "val"
    if ($val == "1") {
        $sql = "SELECT * FROM product WHERE categories = 'fruit'";
    } 
    elseif ($val == "2") {
        $sql = "SELECT * FROM product WHERE categories = 'drinks'";
    }
     elseif ($val == "3") {
        $sql = "SELECT * FROM product WHERE categories = 'egg'";
    } 
    elseif ($val == "4") {
        $sql = "SELECT * FROM product WHERE categories = 'vegetable'";
    }
     elseif ($val == "5") {
        $sql = "SELECT * FROM product WHERE categories = 'sweet'";
    }
     else {
        $sql = "SELECT * FROM product WHERE categories = 'pet'";
    }

  			$stmt = $conn->prepare($sql);
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
                
  		?>
           <div class="cart">
            <a href="product.php?product_id=<?php echo $row["product_id"];?>">
      
            <div class="image">
            <img src="<?= $row['product_image'] ?>">
              </div>
              </a>
              <h4 ><?= $row['product_name'] ?></h4>
              <h5>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?></h5>
              <form action=" " class="form-submit">
              <input type="number" class="pqty" value="1" >
        
                <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
               
                <button class="btn btn-info btn-block addItemBtn">&nbsp;&nbsp;Add to
                  cart</button>            
                  </form>
              </div>
      <?php endwhile; ?>
 
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>


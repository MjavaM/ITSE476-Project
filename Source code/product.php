<?php
require_once("include/db_conn.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="product.css">
</head>
<body>

<main>
    <?php
    
    $product_id = $_GET["product_id"];
    $sql = "SELECT * FROM `product` WHERE product_id = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div name="col">

        <div class="img">
        <form method="get" action="cart.php?product_id''=?=row['product_id']?>"?>

            <img src="<?php echo $row["product_image"]; ?>" alt="Product Image">

            <div name="details">
            <h2><?=$row['product_name']?></h2>
            <h2><?=$row['product_price']?></h2>
            <input type="hidden" name="name" value="<?=$row['product_name']?>">
            <input type="hidden" name="price" value="<?=$row['product_price']?>">
            <input type="number" name="qunatity" value="1" class="form-control">
            </div>

            <button>&nbsp;&nbsp;Add to cart</button>

         </form>
        </div>


        <?php
    } 
    else {
        echo "Product not found.";
    }

    ?>


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

  </main>

</body>
</html>
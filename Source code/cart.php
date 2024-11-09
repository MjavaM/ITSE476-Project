<?php
require_once("include/db_conn.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="header/header.css">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body>
    <header>
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
    </header>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div style="display:<?php echo isset($_SESSION['showAlert']) ? $_SESSION['showAlert'] : 'none'; ?>" class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></strong>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare('SELECT * FROM cart');
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $grand_total = 0;
                        while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                            <td><?= $row['product_name'] ?></td>
                            <td>
                                $&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                            </td>
                            <td>
                                <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                            </td>
                            <td>$&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <a href="editProduct.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <!-- Delete Button -->
                                <a href="deleteProduct.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this item?');"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php  $grand_total +=$row['total_price']; ?>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                            <td><b>Grand Total</b></td>
                            <td><b>$&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <a href="welcome.php?>type=1" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                                <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {
    // Change the item quantity
    $(".itemQty").on('change', function() {
        var $el = $(this).closest('tr');
        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
            url: 'action.php',
            method: 'post',
            cache: false,
            data: {
                qty: qty,
                pid: pid,
                pprice: pprice
            },
            success: function(response) {
                console.log(response);
            }
        });
    });
});
</script>

</body>
</html>

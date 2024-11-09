<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewOrder.css">
    <title>Document</title>
</head>
<body>
<?php 
require_once 'include/db_conn.php';

foreach ($orderResult as $k => $v) { ?>
			<tr>
                    <td><?php echo $orderResult[$k]["orderID"];?></td>
                    <td class="text-right"><?php echo $orderResult[$k]["amount"];?></td>
                    <td class="text-right"><?php echo $orderResult[$k]["order_status"];?></td>
                    <td class="text-right"><a target="_blank"
                        title="Generate Invoice"
                        href="./invoice.php?id=<?php echo $orderResult[$k]["id"];?>"><?php echo $orderResult[$k]["order_invoice"];?></a></td>
            </tr>
            <?php }
?>
</body>
</html>
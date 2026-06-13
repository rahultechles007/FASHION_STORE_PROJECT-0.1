<!---->

<?php

include("config/db.php");

if(!isset($_GET['order_id']))
{
    die("Invalid Invoice");
}

$order_id = (int)$_GET['order_id'];

/* ORDER INFO */
$orderQuery = mysqli_query($conn,
"SELECT * FROM orders WHERE order_id='$order_id'");

$order = mysqli_fetch_assoc($orderQuery);

if(!$order)
{
    die("Order not found");
}

/* ORDER ITEMS */
$itemQuery = mysqli_query($conn,
"SELECT od.*, p.product_name
 FROM order_details od
 INNER JOIN products p
 ON od.product_id = p.product_id
 WHERE od.order_id='$order_id'");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Invoice #<?php echo $order_id; ?></title>

  
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#F5F2EB; }
        .invoice-box { background:#fff; padding:20px; border-radius:10px; }
    </style>

</head>

<body>

<div class="container py-5">

    <div class="invoice-box shadow">

        <h2 class="mb-4">Invoice #<?php echo $order_id; ?></h2>

        <p><strong>Name:</strong> <?php echo $order['customer_name']; ?></p>
        <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
        <p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>

        <hr>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($itemQuery)) { ?>

                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>₹<?php echo $row['price']; ?></td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

        <h4 class="text-end">
            Total: ₹<?php echo $order['total_amount']; ?>
        </h4>

        <div class="text-end mt-3">

            <button onclick="window.print()" class="btn btn-dark">
                Print Invoice
            </button>

        </div>

    </div>

</div>

</body>
</html>
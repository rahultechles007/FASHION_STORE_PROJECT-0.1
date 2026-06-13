<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

if(!isset($_GET['id']))
{
    header("Location: orders.php");
    exit();
}

$order_id = (int)$_GET['id'];

include("includes/header.php");

/* GET ORDER INFO */
$order = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT * FROM orders WHERE order_id='$order_id'"
));

/* GET ORDER ITEMS */
$items = mysqli_query($conn, "
    SELECT order_details.*, products.product_name
    FROM order_details
    INNER JOIN products
    ON order_details.product_id = products.product_id
    WHERE order_id='$order_id'
");

?>

<div class="container py-5">

    <h2 class="mb-4">Order #<?php echo $order_id; ?></h2>

    <div class="card mb-4">
        <div class="card-body">

            <h5>Customer: <?php echo $order['customer_name']; ?></h5>
            <p>Phone: <?php echo $order['phone']; ?></p>
            <p>Address: <?php echo $order['address']; ?></p>
            <p>Total: ₹<?php echo $order['total_amount']; ?></p>

        </div>
    </div>

    <div class="card">

        <div class="card-body table-responsive">

            <table class="table">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($item = mysqli_fetch_assoc($items)) { ?>

                    <tr>

                        <td><?php echo $item['product_name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>₹<?php echo $item['price']; ?></td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
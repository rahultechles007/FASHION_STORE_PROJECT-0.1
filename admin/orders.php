<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

include("includes/header.php");

/* GET ALL ORDERS */
$result = mysqli_query($conn, "
    SELECT * FROM orders
    ORDER BY order_id DESC
");

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container py-5">

    <h2 class="mb-4 fw-bold">All Orders</h2>

    <div class="card shadow border-0">

        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>#<?php echo $row['order_id']; ?></td>

                        <td><?php echo $row['customer_name']; ?></td>

                        <td><?php echo $row['phone']; ?></td>

                        <td>₹<?php echo $row['total_amount']; ?></td>

                        <td>
                            <span class="badge bg-warning text-dark">
                               <td>
<!-- smart upgrade -->
<?php
$status = $row['status'] ?? 'Pending';

if($status == "Pending") {
    echo '<span class="badge bg-warning text-dark">Pending</span>';
}
elseif($status == "Processing") {
    echo '<span class="badge bg-primary">Processing</span>';
}
elseif($status == "Shipped") {
    echo '<span class="badge bg-secondary">Shipped</span>';
}
elseif($status == "Delivered") {
    echo '<span class="badge bg-success">Delivered</span>';
}
else {
    echo '<span class="badge bg-dark">'.$status.'</span>';
}
?>

</td>
                            </span>
                        </td>

                        <td><?php echo $row['order_date'] ?? date('Y-m-d'); ?></td>

                        <td>

                            <a href="order_details.php?id=<?php echo $row['order_id']; ?>"
                               class="btn btn-primary btn-sm">

                                View

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
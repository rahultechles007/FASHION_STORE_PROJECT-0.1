<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

/* =========================
   TOTAL PRODUCTS
========================= */
$productQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
$productCount = mysqli_fetch_assoc($productQuery)['total'];

/* =========================
   TOTAL USERS
========================= */
$userQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$userCount = mysqli_fetch_assoc($userQuery)['total'];

/* =========================
   TOTAL ORDERS
========================= */
$orderQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
$orderCount = mysqli_fetch_assoc($orderQuery)['total'];

/* =========================
   TOTAL REVENUE
========================= */
$revenueQuery = mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders");
$revenue = mysqli_fetch_assoc($revenueQuery)['total'] ?? 0;

/* =========================
   SALES CHART DATA
========================= */
$salesQuery = mysqli_query($conn,
"SELECT DATE(order_date) AS date,
 SUM(total_amount) AS total,
 COUNT(order_id) AS orders
 FROM orders
 GROUP BY DATE(order_date)
 ORDER BY date ASC"
);

$dates = [];
$totals = [];
$orderCounts = [];

while($row = mysqli_fetch_assoc($salesQuery))
{
    $dates[] = $row['date'];
    $totals[] = $row['total'] ?? 0;
    $orderCounts[] = $row['orders'] ?? 0;
}

include("includes/header.php");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="container py-5">

    <h2 class="mb-4 fw-bold">
        Admin Dashboard
    </h2>

    <!-- =========================
         STATS CARDS
    ========================== -->
    <div class="row g-4">

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 text-center p-4">
                <h5>Total Products</h5>
                <h2 class="text-warning"><?php echo $productCount; ?></h2>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 text-center p-4">
                <h5>Total Users</h5>
                <h2 class="text-success"><?php echo $userCount; ?></h2>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 text-center p-4">
                <h5>Total Orders</h5>
                <h2 class="text-primary"><?php echo $orderCount; ?></h2>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 text-center p-4">
                <h5>Total Revenue</h5>
                <h2 class="text-danger">
                    ₹<?php echo number_format($revenue); ?>
                </h2>
            </div>
        </div>

    </div>

    <!-- =========================
         CHART SECTION
    ========================== -->
    <div class="card shadow border-0 mt-5">

        <div class="card-body">

            <h5 class="mb-4">Sales Overview</h5>

            <div class="row">

                <div class="col-md-6">
                    <canvas id="salesChart"></canvas>
                </div>

                <div class="col-md-6">
                    <canvas id="orderChart"></canvas>
                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>

<!-- =========================
     CHART JS LOGIC
========================= -->
<script>

const labels = <?php echo json_encode($dates); ?>;
const revenue = <?php echo json_encode($totals); ?>;
const orders = <?php echo json_encode($orderCounts); ?>;

/* REVENUE CHART */
new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Revenue (₹)',
            data: revenue,
            borderWidth: 2,
            fill: false
        }]
    }
});

/* ORDERS CHART */
new Chart(document.getElementById('orderChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Orders',
            data: orders,
            borderWidth: 2
        }]
    }
});

</script>

</body>
</html>
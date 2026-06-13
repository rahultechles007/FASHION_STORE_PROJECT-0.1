<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

/* TOTAL PRODUCTS */
$productQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
$productCount = mysqli_fetch_assoc($productQuery)['total'];

/* TOTAL USERS */
$userQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$userCount = mysqli_fetch_assoc($userQuery)['total'];

/* TOTAL ORDERS */
$orderQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
$orderCount = mysqli_fetch_assoc($orderQuery)['total'];

/* TOTAL REVENUE */
$revenueQuery = mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders");
$revenue = mysqli_fetch_assoc($revenueQuery)['total'] ?? 0;

include("includes/header.php");

?>

<div class="container py-5">

    <h2 class="mb-4 fw-bold">
        Admin Dashboard
    </h2>

    <div class="row g-4">

        <!-- PRODUCTS -->
        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 text-center p-4">

                <h5>Total Products</h5>
                <h2 class="text-warning">
                    <?php echo $productCount; ?>
                </h2>

            </div>

        </div>

        <!-- USERS -->
        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 text-center p-4">

                <h5>Total Users</h5>
                <h2 class="text-success">
                    <?php echo $userCount; ?>
                </h2>

            </div>

        </div>

        <!-- ORDERS -->
        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 text-center p-4">

                <h5>Total Orders</h5>
                <h2 class="text-primary">
                    <?php echo $orderCount; ?>
                </h2>

            </div>

        </div>

        <!-- REVENUE -->
        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 text-center p-4">

                <h5>Total Revenue</h5>
                <h2 class="text-danger">
                    ₹<?php echo number_format($revenue); ?>
                </h2>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
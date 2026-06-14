<?php

session_start();
include("config/db.php");
include("includes/header.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$orders = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE user_id='$user_id'
     ORDER BY order_id DESC"
);

?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<style>

.order-card{
    border:none;
    border-radius:15px;
    transition:.3s;
}

.order-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,.12);
}

.order-icon{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#f8f9fa;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.order-id{
    color:#6c757d;
    font-size:14px;
}

.price-text{
    font-size:22px;
    font-weight:700;
    color:#198754;
}

.empty-orders{
    max-width:500px;
    margin:auto;
}

</style>

<div class="container py-5">

    <!-- PAGE HEADER -->

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            My Orders
        </h1>

        <p class="text-muted">
            View and track all your recent purchases
        </p>

    </div>

    <?php if(mysqli_num_rows($orders) > 0) { ?>

        <div class="row g-4">

        <?php while($order = mysqli_fetch_assoc($orders)) { ?>

            <div class="col-lg-6">

                <div class="card shadow-sm order-card">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center">

                            <div class="order-icon me-3">

                                <i class="fa-solid fa-box text-primary"></i>

                            </div>

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Order #<?php echo $order['order_id']; ?>
                                </h5>

                                <div class="order-id">
                                    Placed Successfully
                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-6">

                                <small class="text-muted">
                                    Customer
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $order['customer_name']; ?>
                                </div>

                            </div>

                            <div class="col-6">

                                <small class="text-muted">
                                    Phone
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $order['phone']; ?>
                                </div>

                            </div>

                        </div>

                        <div class="mt-3">

                            <small class="text-muted">
                                Delivery Address
                            </small>

                            <div>
                                <?php echo $order['address']; ?>
                            </div>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <span class="badge bg-success px-3 py-2">
                                    Confirmed
                                </span>

                            </div>

                            <div class="price-text">

                                ₹<?php echo number_format($order['total_amount']); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php } ?>

        </div>

    <?php } else { ?>

        <!-- EMPTY ORDERS -->

        <div class="card shadow border-0 empty-orders">

            <div class="card-body text-center p-5">

                <i class="fa-solid fa-cart-shopping
                   text-secondary mb-3"
                   style="font-size:70px;">
                </i>

                <h3 class="fw-bold">
                    No Orders Yet
                </h3>

                <p class="text-muted">

                    Looks like you haven't placed any orders.

                </p>

                <a href="products.php"
                   class="btn btn-dark">

                    Start Shopping

                </a>

            </div>

        </div>

    <?php } ?>

</div>

<?php include("includes/footer.php"); ?>
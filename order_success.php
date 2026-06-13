<?php

session_start();
include("config/db.php");
include("includes/header.php");

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container py-5 text-center">

    <div class="card border-0 shadow-sm">

        <div class="card-body py-5">

            <h1 class="text-success">
                Order Placed Successfully!
            </h1>

            <p class="lead">
                Thank you for shopping with us.
            </p>

            <a
                href="products.php"
                class="btn btn-gold">

                Continue Shopping

            </a>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
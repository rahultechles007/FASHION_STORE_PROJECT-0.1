<?php

include("config/db.php");
include("includes/header.php");

$products = mysqli_query(
    $conn,
    "SELECT * FROM products ORDER BY product_id DESC"
);

?>

<div class="container py-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            Our Collection
        </h1>

        <p class="text-secondary">
            Discover premium fashion products.
        </p>

    </div>

    <div class="row g-4">

        <?php while($product = mysqli_fetch_assoc($products)) { ?>

        <div class="col-lg-3 col-md-6">

            <div class="card h-100 shadow-sm border-0 product-card">

                <img
                    src="assets/images/products/<?php echo $product['image']; ?>"
                    class="card-img-top"
                    style="height:300px;object-fit:cover;"
                    alt="Product">

                <div class="card-body">

                    <h5 class="fw-bold">
                        <?php echo $product['product_name']; ?>
                    </h5>

                    <p class="text-muted">
                        <?php echo $product['category']; ?>
                    </p>

                    <h5 class="text-warning">
                        ₹<?php echo number_format($product['price']); ?>
                    </h5>

                    <a
                        href="product_details.php?id=<?php echo $product['product_id']; ?>"
                        class="btn btn-gold w-100 mt-2">

                        View Details

                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

<?php include("includes/footer.php"); ?>
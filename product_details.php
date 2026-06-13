<?php

include("config/db.php");

// Check if product ID exists
if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$product_id = (int)$_GET['id'];

$productQuery = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE product_id = $product_id"
);

if(mysqli_num_rows($productQuery) == 0)
{
    header("Location: products.php");
    exit();
}

$product = mysqli_fetch_assoc($productQuery);

//cart section 

$message = "";

if(isset($_POST['add_to_cart']))
{
    // User must be logged in
    if(!isset($_SESSION['user_id']))
    {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $quantity = (int)$_POST['quantity'];

    if($quantity < 1)
    {
        $quantity = 1;
    }

    // Check if product already exists in cart
    $cartCheck = mysqli_query(
        $conn,
        "SELECT * FROM cart
         WHERE user_id='$user_id'
         AND product_id='$product_id'"
    );

    if(mysqli_num_rows($cartCheck) > 0)
    {
        mysqli_query(
            $conn,
            "UPDATE cart
             SET quantity = quantity + $quantity
             WHERE user_id='$user_id'
             AND product_id='$product_id'"
        );
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO cart(user_id,product_id,quantity)
             VALUES('$user_id','$product_id','$quantity')"
        );
    }

    $message = "Product added to cart successfully!";
}
//cart section end 

include("includes/header.php");

?>

<div class="container py-5">

    <div class="row g-5">

        <!-- Product Image -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm">

              <img
                         src="assets/images/products/<?php echo $product['image']; ?>"
                        class="img-fluid rounded"
                        alt="<?php echo $product['product_name']; ?>"
              >

            </div>

        </div>

        <!-- Product Info -->
        <div class="col-lg-6">

            <span class="badge bg-dark mb-3">
                <?php echo $product['category']; ?>
            </span>

            <h1 class="fw-bold mb-3">
                <?php echo $product['product_name']; ?>
            </h1>

            <h2 class="text-warning mb-4">
                ₹<?php echo number_format($product['price']); ?>
            </h2>

            <p class="text-secondary">
                <?php echo $product['description']; ?>
            </p>

            <!-- Stock Status -->

            <?php if($product['stock'] > 0) { ?>

                <p class="text-success fw-bold">
                    In Stock (<?php echo $product['stock']; ?> available)
                </p>

            <?php } else { ?>

                <p class="text-danger fw-bold">
                    Out of Stock
                </p>

            <?php } ?>

            <!-- Quantity -->
<!-- New changes has been done in quantity and button -->

<?php if(!empty($message)) { ?>
    <div class="alert alert-success">
        <?php echo $message; ?>
    </div>
<?php } ?>

<form method="POST">

    <div class="mb-4">

        <label class="form-label fw-bold">
            Quantity
        </label>

        <input
            type="number"
            name="quantity"
            min="1"
            value="1"
            class="form-control"
            style="max-width:150px;">

    </div>

    <button
        type="submit"
        name="add_to_cart"
        class="btn btn-gold btn-lg">

        Add To Cart

    </button>

</form>

        </div>

    </div>

</div>

<!-- Related Products -->

<div class="container py-5">

    <h3 class="mb-4">
        Related Products
    </h3>

    <div class="row g-4">

        <?php

        $relatedProducts = mysqli_query(
            $conn,
            "SELECT * FROM products
             WHERE product_id != $product_id
             LIMIT 4"
        );

        while($related = mysqli_fetch_assoc($relatedProducts))
        {

        ?>

        <div class="col-lg-3 col-md-6">

            <div class="card product-card border-0 shadow-sm">

                <img
                    src="assets/images/products/<?php echo $related['image']; ?>"
                    class="card-img-top"
                    style="height:250px;object-fit:cover;"
                    alt="Product">

                <div class="card-body">

                    <h5>
                        <?php echo $related['product_name']; ?>
                    </h5>

                    <p class="text-secondary">
                        <?php echo $related['category']; ?>
                    </p>

                    <h5 class="text-warning">
                        ₹<?php echo number_format($related['price']); ?>
                    </h5>

                    <a
                        href="product_details.php?id=<?php echo $related['product_id']; ?>"
                        class="btn btn-outline-dark w-100">

                        View Product

                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

<?php include("includes/footer.php"); ?>
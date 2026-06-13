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

/* Remove item from cart */
if(isset($_GET['remove']))
{
    $cart_id = (int)$_GET['remove'];

    mysqli_query(
        $conn,
        "DELETE FROM cart
         WHERE cart_id='$cart_id'
         AND user_id='$user_id'"
    );

    header("Location: cart.php");
    exit();
}



$total = 0;

$cartItems = mysqli_query(
    $conn,
    "SELECT cart.*,
            products.product_name,
            products.price,
            products.image
     FROM cart
     INNER JOIN products
     ON cart.product_id = products.product_id
     WHERE cart.user_id='$user_id'"
);

?>

<div class="container py-5">

    <h1 class="fw-bold mb-4">
        Shopping Cart
    </h1>

    <?php if(mysqli_num_rows($cartItems) > 0) { ?>

        <div class="table-responsive">

            <table class="table align-middle bg-white">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($item = mysqli_fetch_assoc($cartItems)) {

                    $subtotal =
                        $item['price'] * $item['quantity'];

                    $total += $subtotal;

                ?>

                    <tr>

                        <td>

                            <div class="d-flex align-items-center">

                                <img
                                    src="assets/images/products/<?php echo $item['image']; ?>"
                                    width="80"
                                    height="80"
                                    style="object-fit:cover;border-radius:12px;">

                                <div class="ms-3">

                                    <h6 class="mb-0">
                                        <?php echo $item['product_name']; ?>
                                    </h6>

                                </div>

                            </div>

                        </td>

                        <td>
                            ₹<?php echo number_format($item['price']); ?>
                        </td>

                        <td>
                            <?php echo $item['quantity']; ?>
                        </td>

                        <td>
                            ₹<?php echo number_format($subtotal); ?>
                        </td>

                        <td>

                            <a
                                href="cart.php?remove=<?php echo $item['cart_id']; ?>"
                                class="btn btn-sm btn-danger">

                                Remove

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <h4>
                        Grand Total
                    </h4>

                    <h4 class="text-warning">
                        ₹<?php echo number_format($total); ?>
                    </h4>

                </div>

                <a
                    href="checkout.php"
                    class="btn btn-gold mt-3">

                    Proceed To Checkout

                </a>

            </div>

        </div>

    <?php } else { ?>

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <h3>
                    Your Cart Is Empty
                </h3>

                <p class="text-secondary">
                    Start shopping and add products.
                </p>

                <a
                    href="products.php"
                    class="btn btn-gold">

                    Browse Products

                </a>

            </div>

        </div>

    <?php } ?>

</div>

<?php include("includes/footer.php"); ?>
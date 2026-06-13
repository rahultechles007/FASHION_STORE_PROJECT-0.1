<?php

session_start();
include("config/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Here to " adding order processing code is impportant process"
    if(isset($_POST['place_order']))
{
    $customer_name = mysqli_real_escape_string(
        $conn,
        $_POST['customer_name']
    );

    $phone = mysqli_real_escape_string(
        $conn,
        $_POST['phone']
    );

    $address = mysqli_real_escape_string(
        $conn,
        $_POST['address']
    );

    $total_amount = 0;

    $cartQuery = mysqli_query(
        $conn,
        "SELECT cart.*,
                products.price
         FROM cart
         INNER JOIN products
         ON cart.product_id = products.product_id
         WHERE cart.user_id='$user_id'"
    );

    while($item = mysqli_fetch_assoc($cartQuery))
    {
        $total_amount +=
            $item['price'] * $item['quantity'];
    }

    mysqli_query(
        $conn,
        "INSERT INTO orders
        (
            user_id,
            total_amount,
            customer_name,
            phone,
            address
        )
        VALUES
        (
            '$user_id',
            '$total_amount',
            '$customer_name',
            '$phone',
            '$address'
        )"
    );

    $order_id = mysqli_insert_id($conn);

    $cartQuery = mysqli_query(
        $conn,
        "SELECT cart.*,
                products.price
         FROM cart
         INNER JOIN products
         ON cart.product_id = products.product_id
         WHERE cart.user_id='$user_id'"
    );

    while($item = mysqli_fetch_assoc($cartQuery))
    {
        mysqli_query(
            $conn,
            "INSERT INTO order_details
            (
                order_id,
                product_id,
                quantity,
                price
            )
            VALUES
            (
                '$order_id',
                '{$item['product_id']}',
                '{$item['quantity']}',
                '{$item['price']}'
            )"
        );
    }

    mysqli_query(
        $conn,
        "DELETE FROM cart
         WHERE user_id='$user_id'"
    );

    header("Location: order_success.php?id=".$order_id);
    exit();
}
// ends here 
include("includes/header.php");
?>
<!-- this main for load items -->
 <?php

$total = 0;

$cartItems = mysqli_query(
    $conn,
    "SELECT cart.*,
            products.product_name,
            products.price
     FROM cart
     INNER JOIN products
     ON cart.product_id = products.product_id
     WHERE cart.user_id='$user_id'"
);

?>

<!-- this is the layout in which checkout layout is done -->
 <div class="container py-5">

    <h1 class="fw-bold mb-4">
        Checkout
    </h1>

    <div class="row">

        <div class="col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Delivery Address
                            </label>

                            <textarea
                                name="address"
                                rows="4"
                                class="form-control"
                                required></textarea>

                        </div>

                        <button
                            type="submit"
                            name="place_order"
                            class="btn btn-gold">

                            Place Order

                        </button>

                    </form>

                </div>

            </div>

        </div>


<!-- Here comes the order summary sections-->

        <div class="col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h4 class="mb-3">
                        Order Summary
                    </h4>

                    <?php while($item = mysqli_fetch_assoc($cartItems)) {

                        $subtotal =
                            $item['price'] *
                            $item['quantity'];

                        $total += $subtotal;

                    ?>

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                <?php echo $item['product_name']; ?>
                                ×
                                <?php echo $item['quantity']; ?>
                            </span>

                            <span>
                                ₹<?php echo number_format($subtotal); ?>
                            </span>

                        </div>

                    <?php } ?>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <strong>Total</strong>

                        <strong>
                            ₹<?php echo number_format($total); ?>
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
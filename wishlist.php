<?php
session_start();
include("config/db.php");

$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn,
"SELECT products.*
 FROM wishlist
 JOIN products ON wishlist.product_id = products.product_id
 WHERE wishlist.user_id='$user_id'");
?>

<div class="container py-5">

    <h2>My Wishlist</h2>

    <div class="row">

        <?php while($row = mysqli_fetch_assoc($data)) { ?>

        <div class="col-md-3">

            <div class="card p-2">

                <img src="assets/images/products/<?php echo $row['image']; ?>"
                     class="img-fluid">

                <h6><?php echo $row['product_name']; ?></h6>

                <p>₹<?php echo $row['price']; ?></p>

            </div>

        </div>

        <?php } ?>

    </div>

</div>
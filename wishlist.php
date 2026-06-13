<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn,
"SELECT products.*
 FROM wishlist
 JOIN products ON wishlist.product_id = products.product_id
 WHERE wishlist.user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f6fa;
}

.wishlist-card{
    transition:0.3s;
    border-radius:15px;
    overflow:hidden;
}

.wishlist-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 20px rgba(0,0,0,0.1);
}

.wishlist-img{
    height:220px;
    object-fit:cover;
}

.empty-box{
    text-align:center;
    padding:80px 20px;
    color:#888;
}
</style>

</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center">My Wishlist</h2>

    <div class="row g-4">

        <?php if(mysqli_num_rows($data) > 0) { ?>

            <?php while($row = mysqli_fetch_assoc($data)) { ?>

                <div class="col-lg-3 col-md-4 col-6">

                    <div class="card wishlist-card shadow-sm border-0 h-100">

                        <img src="assets/images/products/<?php echo $row['image']; ?>"
                             class="card-img-top wishlist-img">

                        <div class="card-body text-center">

                            <h6 class="fw-bold">
                                <?php echo $row['product_name']; ?>
                            </h6>

                            <p class="text-warning fw-bold">
                                ₹<?php echo number_format($row['price']); ?>
                            </p>

                            <a href="product_details.php?id=<?php echo $row['product_id']; ?>"
                               class="btn btn-dark btn-sm w-100 mb-2">
                                View Product
                            </a>

                            <a href="remove_wishlist.php?id=<?php echo $row['product_id']; ?>"
                               class="btn btn-outline-danger btn-sm w-100">
                                Remove
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="empty-box">
                <h4>Your wishlist is empty</h4>
                <p>Add products you love 
                    
                </p>
                <a href="products.php" class="btn btn-dark mt-3">
                    Browse Products
                </a>
            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>
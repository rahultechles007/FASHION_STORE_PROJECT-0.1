<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

include("includes/header.php");

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY product_id DESC");

?>

<div class="container py-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Products</h2>

        <a href="add_product.php" class="btn btn-success">
            + Add Product
        </a>

    </div>

    <div class="card shadow border-0">

        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td><?php echo $row['product_id']; ?></td>

                        <td>
                            <img src="../assets/images/products/<?php echo $row['image']; ?>" width="60">
                        </td>

                        <td><?php echo $row['name']; ?></td>

                        <td>₹<?php echo $row['price']; ?></td>

                        <td><?php echo substr($row['description'],0,50); ?>...</td>

                        <td>

                            <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="delete_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
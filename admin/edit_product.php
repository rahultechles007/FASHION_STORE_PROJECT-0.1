<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

/* GET PRODUCT ID */
if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = (int)$_GET['id'];

/* FETCH PRODUCT */
$result = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$id'");
$product = mysqli_fetch_assoc($result);

if(!$product)
{
    header("Location: products.php");
    exit();
}

$message = "";

/* UPDATE PRODUCT */
if(isset($_POST['update_product']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $image_name = $product['image']; // default old image

    /* If new image uploaded */
    if(!empty($_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $upload_folder = "../assets/images/products/";

        $image_name = time() . "_" . $image;

        move_uploaded_file($tmp, $upload_folder . $image_name);
    }

    $update = mysqli_query($conn,
        "UPDATE products SET
            product_name='$name',
            price='$price',
            description='$description',
            image='$image_name'
         WHERE product_id='$id'"
    );

    if($update)
    {
        $message = "Product updated successfully!";
    }
    else
    {
        $message = "Update failed!";
    }
}

include("includes/header.php");

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container py-5">

    <h2 class="mb-4 fw-bold">Edit Product</h2>

    <?php if($message != "") { ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="card shadow border-0">

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name"
                     value="<?php echo $product['product_name']; ?>"
                     class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price"
                           value="<?php echo $product['price']; ?>"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required><?php echo $product['description']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Current Image</label><br>
                    <img src="../assets/images/products/<?php echo $product['image']; ?>"
                         width="100" class="mb-2">
                </div>

                <div class="mb-3">
                    <label>Change Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" name="update_product" class="btn btn-warning">
                    Update Product
                </button>

                <a href="products.php" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
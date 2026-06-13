<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

$message = "";

/* ADD PRODUCT */
if(isset($_POST['add_product']))
{
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock = $_POST['stock'];// stocked is added
    // IMAGE UPLOAD
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $upload_folder = "../assets/images/products/";

    if(!file_exists($upload_folder))
    {
        mkdir($upload_folder, 0777, true);
    }

    // unique image name
    $image_name = time() . "_" . $image;

    // move file
    if(move_uploaded_file($tmp_name, $upload_folder . $image_name))
    {
        $query = mysqli_query($conn,
       "INSERT INTO products(product_name, price, description, image, stock)
        VALUES('$product_name', '$price', '$description', '$image_name', '$stock')");

        if($query)
        {
            $message = "Product added successfully!";
        }
        else
        {
            $message = "Database error while adding product.";
        }
    }
    else
    {
        $message = "Image upload failed.";
    }
}

include("includes/header.php");

?>

<div class="container py-5">

    <h2 class="mb-4 fw-bold">Add Product</h2>

    <?php if($message != "") { ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php } ?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <div class="card shadow border-0">

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <button type="submit" name="add_product" class="btn btn-success">
                    Add Product
                </button>

            </form>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>
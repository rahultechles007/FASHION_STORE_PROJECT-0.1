<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

/* CHECK ID */
if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = (int)$_GET['id'];

/* GET PRODUCT IMAGE (for deleting file) */
$query = mysqli_query($conn, "SELECT image FROM products WHERE product_id='$id'");
$product = mysqli_fetch_assoc($query);

if($product)
{
    $image_path = "../assets/images/products/" . $product['image'];

    /* DELETE IMAGE FILE */
    if(file_exists($image_path))
    {
        unlink($image_path);
    }

    /* DELETE FROM DATABASE */
mysqli_query($conn, "DELETE FROM cart WHERE product_id='$id'");
mysqli_query($conn, "DELETE FROM order_details WHERE product_id='$id'");
mysqli_query($conn, "DELETE FROM products WHERE product_id='$id'");
    }   

header("Location: products.php?deleted=1");
exit();

?>
<?php
session_start();
include("config/db.php");

header('Content-Type: application/json');

if(!isset($_SESSION['user_id']))
{
    echo json_encode([
        "status" => "error",
        "message" => "Login required"
    ]);
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;

/* check if already in cart */
$check = mysqli_query($conn,
"SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$product_id'");

if(mysqli_num_rows($check) > 0)
{
    mysqli_query($conn,
    "UPDATE cart SET quantity = quantity + $quantity
     WHERE user_id='$user_id' AND product_id='$product_id'");
}
else
{
    mysqli_query($conn,
    "INSERT INTO cart (user_id, product_id, quantity)
     VALUES ('$user_id', '$product_id', '$quantity')");
}

echo json_encode([
    "status" => "success",
    "message" => "Added to cart"
]);
?>
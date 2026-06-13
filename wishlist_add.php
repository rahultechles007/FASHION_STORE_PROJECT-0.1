<?php
session_start();
include("config/db.php");

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

mysqli_query($conn,
"INSERT INTO wishlist (user_id, product_id)
 VALUES ('$user_id', '$product_id')");

header("Location: wishlist.php");
exit();
?>
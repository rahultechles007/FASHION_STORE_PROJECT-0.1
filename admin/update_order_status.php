<?php

session_start();
include(__DIR__ . "/../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

/* VALIDATE INPUT */
if(!isset($_GET['id']) || !isset($_GET['status']))
{
    header("Location: orders.php");
    exit();
}

$order_id = (int)$_GET['id'];
$status = mysqli_real_escape_string($conn, $_GET['status']);

/* ALLOWED STATUSES (security) */
$allowed = ['Pending', 'Processing', 'Shipped', 'Delivered'];

if(!in_array($status, $allowed))
{
    header("Location: orders.php");
    exit();
}

/* UPDATE STATUS */
mysqli_query(
    $conn,
    "UPDATE orders
     SET status='$status'
     WHERE order_id='$order_id'"
);

header("Location: order_details.php?id=$order_id&updated=1");
exit();

?>
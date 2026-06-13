<?php
session_start();
include("config/db.php");

$user_id = $_SESSION['user_id'];

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn,
    "UPDATE users SET
     name='$name',
     phone='$phone',
     address='$address'
     WHERE id='$user_id'");

    header("Location: profile.php");
}
?>

<form method="POST" class="container py-5">

    <input name="name" class="form-control mb-2" placeholder="Name">
    <input name="phone" class="form-control mb-2" placeholder="Phone">
    <textarea name="address" class="form-control mb-2" placeholder="Address"></textarea>

    <button name="update" class="btn btn-success">
        Update Profile
    </button>

</form>
<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM users WHERE id='$user_id'"));
?>

<div class="container py-5">

    <h2>My Profile</h2>

    <div class="card p-4 shadow-sm">

        <p><b>Name:</b> <?php echo $user['name']; ?></p>
        <p><b>Email:</b> <?php echo $user['email']; ?></p>
        <p><b>Phone:</b> <?php echo $user['phone']; ?></p>
        <p><b>Address:</b> <?php echo $user['address']; ?></p>

        <a href="edit_profile.php" class="btn btn-primary">
            Edit Profile
        </a>

        <a href="wishlist.php" class="btn btn-danger">
            My Wishlist
        </a>

        <a href="settings.php" class="btn btn-dark">
            Settings
        </a>

    </div>

</div>
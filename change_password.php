<?php
session_start();
include("config/db.php");

$user_id = $_SESSION['user_id'];

if(isset($_POST['update']))
{
    $old = md5($_POST['old_password']);
    $new = md5($_POST['new_password']);

    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE user_id='$user_id' AND password='$old'");

    if(mysqli_num_rows($check) > 0)
    {
        mysqli_query($conn,
        "UPDATE users SET password='$new' WHERE user_id='$user_id'");

        echo "Password updated successfully";
    }
    else
    {
        echo "Old password incorrect";
    }
}
?>

<form method="POST">
    <input type="password" name="old_password" placeholder="Old Password">
    <input type="password" name="new_password" placeholder="New Password">
    <button name="update">Change Password</button>
</form>
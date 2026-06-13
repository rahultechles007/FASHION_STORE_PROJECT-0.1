<?php
session_start();
include("config/db.php");

$user_id = $_SESSION['user_id'];

$settings = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM user_settings WHERE user_id='$user_id'"));

if(isset($_POST['save']))
{
    $dark = isset($_POST['dark_mode']) ? 1 : 0;

    mysqli_query($conn,
    "INSERT INTO user_settings (user_id, dark_mode)
     VALUES ('$user_id', '$dark')
     ON DUPLICATE KEY UPDATE dark_mode='$dark'");

    header("Location: settings.php");
}
?>

<form method="POST" class="container py-5">

    <label>
        <input type="checkbox" name="dark_mode"
        <?php if($settings['dark_mode'] ?? 0) echo "checked"; ?>>
        Enable Dark Mode
    </label>

    <button name="save" class="btn btn-dark mt-3">
        Save
    </button>

</form>
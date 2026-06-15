<?php
session_start();
include("config/db.php");

$user_id = $_SESSION['user_id'];
$dark = $_POST['dark_mode'];

mysqli_query($conn,
"INSERT INTO user_settings (user_id, dark_mode)
 VALUES ('$user_id', '$dark')
 ON DUPLICATE KEY UPDATE dark_mode='$dark'");

echo json_encode(["status"=>"success"]);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$("#darkToggle").on("change", function(){

    let dark = $(this).is(":checked") ? 1 : 0;
    $.post("update_settings.php",
    {dark_mode: dark},
    function(response){
        console.log(response);
        location.reload();
    });

});
</script>
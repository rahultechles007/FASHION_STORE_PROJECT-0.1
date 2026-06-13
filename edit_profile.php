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
"SELECT * FROM users WHERE user_id='$user_id'"));

/* IMAGE UPLOAD */
if(isset($_FILES['profile_image']['name']))
{
    $image = $_FILES['profile_image']['name'];
    $tmp = $_FILES['profile_image']['tmp_name'];

    $newName = time() . "_" . $image;

    $upload_dir = __DIR__ . "/assets/images/users/";

    if(!file_exists($upload_dir))
    {
        mkdir($upload_dir, 0777, true);
    }

    if(move_uploaded_file($tmp, $upload_dir . $newName))
    {
        mysqli_query($conn,
        "UPDATE users SET profile_image='$newName'
         WHERE user_id='$user_id'");
    }
}

/* UPDATE PROFILE */
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
     WHERE user_id='$user_id'");

    header("Location: profile.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f6fa;
}

.profile-card{
    max-width:600px;
    margin:auto;
    border-radius:20px;
    animation:fadeIn 0.5s ease;
}

.profile-img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #fff;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}
</style>
</head>

<body>

<div class="container py-5">

    <div class="card shadow profile-card p-4">

        <h3 class="text-center mb-4 fw-bold">
            Edit Profile
        </h3>

        <!-- PROFILE IMAGE -->
        <div class="text-center mb-4">

            <img src="assets/images/users/<?php echo $user['profile_image'] ?? 'default.png'; ?>"
                 class="profile-img mb-3">

            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_image" class="form-control mb-2">
                <button class="btn btn-dark btn-sm w-100">
                    Upload Image
                </button>
            </form>

        </div>

        <!-- PROFILE FORM -->
        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name"
                       value="<?php echo $user['name']; ?>"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="phone"
                       value="<?php echo $user['phone']; ?>"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address"
                          class="form-control"
                          rows="3"><?php echo $user['address']; ?></textarea>
            </div>

            <button name="update" class="btn btn-success w-100">
                Save Changes
            </button>

        </form>

    </div>

</div>

</body>
</html>
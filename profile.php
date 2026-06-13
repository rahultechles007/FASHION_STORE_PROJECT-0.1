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
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: #f5f6fa;
}

.profile-card{
    max-width: 500px;
    margin: auto;
    border-radius: 20px;
    overflow: hidden;
    animation: fadeUp 0.8s ease;
    transition: 0.3s;
}

.profile-card:hover{
    transform: translateY(-5px);
}

.profile-header{
    background: linear-gradient(135deg, #111, #333);
    height: 120px;
    position: relative;
}

.profile-img{
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 4px solid white;
    object-fit: cover;
    position: absolute;
    bottom: -55px;
    left: 50%;
    transform: translateX(-50%);
    background: #fff;
}

.profile-body{
    padding-top: 70px;
    text-align: center;
}

.profile-body p{
    margin: 6px 0;
    font-size: 15px;
}

.btn-custom{
    width: 100%;
    margin-top: 10px;
    border-radius: 10px;
}

@keyframes fadeUp{
    from{
        opacity: 0;
        transform: translateY(30px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

</head>

<body>

<div class="container py-5">

    <div class="profile-card shadow bg-white">

        <!-- HEADER -->
        <div class="profile-header">

            <img src="assets/images/users/<?php echo $user['profile_image'] ?? 'default.png'; ?>"
                 class="profile-img">

        </div>

        <!-- BODY -->
        <div class="profile-body">

            <h4 class="fw-bold mt-2">
                <?php echo $user['name']; ?>
            </h4>

            <p class="text-muted">
                <?php echo $user['email']; ?>
            </p>

            <hr>

            <p><b>Phone:</b> <?php echo $user['phone']; ?></p>
            <p><b>Address:</b> <?php echo $user['address']; ?></p>

            <a href="edit_profile.php" class="btn btn-primary btn-custom">
                Edit Profile
            </a>

            <a href="wishlist.php" class="btn btn-danger btn-custom">
                My Wishlist
            </a>

            <a href="settings.php" class="btn btn-dark btn-custom">
                Settings
            </a>

        </div>

    </div>

</div>

</body>
</html>
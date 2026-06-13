<?php
include_once("config/db.php");
include_once("includes/header.php");

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}

$cartCount = 0;

if(isset($conn) && isset($_SESSION['user_id']))
{
    $uid = $_SESSION['user_id'];

    $countQuery = mysqli_query(
        $conn,
        "SELECT SUM(quantity) AS total
         FROM cart
         WHERE user_id='$uid'"
    );

    if($countQuery)
    {
        $countData = mysqli_fetch_assoc($countQuery);
        $cartCount = $countData['total'] ?? 0;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>Modern Fashion Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    .brand-logo{
    font-family:'Times New Roman', serif;
    font-size:2.3rem;
    font-weight:700;
    letter-spacing:4px;
    color:var(--dark);
    text-transform:uppercase;
}

.brand-logo span{
    color:var(--gold);
    font-size:2.7rem;
}

.brand-logo i{
    color:var(--gold);
    margin-right:10px;
}
</style>
<body>
    <?php

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}

$darkMode = 0;

if(isset($_SESSION['user_id']))
{
    $uid = $_SESSION['user_id'];

    $q = mysqli_query($conn,
    "SELECT dark_mode FROM user_settings WHERE user_id='$uid'");

    $d = mysqli_fetch_assoc($q);

    $darkMode = $d['dark_mode'] ?? 0;
}

$cartCount = 0;

if(isset($conn) && isset($_SESSION['user_id']))
{
    $uid = $_SESSION['user_id'];

    $countQuery = mysqli_query(
        $conn,
        "SELECT SUM(quantity) AS total
         FROM cart
         WHERE user_id='$uid'"
    );

    if($countQuery)
    {
        $countData = mysqli_fetch_assoc($countQuery);
        $cartCount = $countData['total'] ?? 0;
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        <div class="col-12 col-lg-4 text-center text-lg-start mb-3 mb-lg-0">
        <a href="#" class="brand-logo text-decoration-none">
          <i class="fa-solid fa-gem"></i>
              VE<span>L</span>ORA
        </a>
      </div>

        <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

           <ul class="navbar-nav ms-auto">

    <li class="nav-item">
        <a class="nav-link" href="landing.php">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
    </li>
    <li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle"
       data-bs-toggle="dropdown">
        My Account
    </a>

    <ul class="dropdown-menu">

        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><a class="dropdown-item" href="wishlist.php">Wishlist</a></li>
        <li><a class="dropdown-item" href="/fashion/includes/settings.php">Settings</a></li>

    </ul>

</li>

    <li class="nav-item">
    <a class="nav-link" href="cart.php">

        Cart

        <?php if($cartCount > 0){ ?>

            <span class="badge bg-dark">
                <?php echo $cartCount; ?>
            </span>

        <?php } ?>

    </a>
</li>


    <?php if(isset($_SESSION['user_id'])) { ?>

        <li class="nav-item">
            <span class="nav-link">
                Hi, <?php echo $_SESSION['user_name']; ?>
            </span>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                Logout
            </a>
        </li>

    <?php } else { ?>

        <li class="nav-item">
            <a class="nav-link" href="login.php">
                Login
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="register.php">
                Register
            </a>
        </li>

    <?php } ?>

</ul>

        </div>

    </div>
</nav>
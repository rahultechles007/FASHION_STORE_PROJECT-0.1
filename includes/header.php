<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Modern Fashion Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="landing.php">
            Fashion Store
        </a>

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

    <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
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
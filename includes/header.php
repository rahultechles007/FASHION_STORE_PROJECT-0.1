<?php

include_once("includes/header.php");

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}

include_once(__DIR__ . "/../config/db.php");
$darkMode = 0;

if(isset($_SESSION['user_id']))
{
    $uid = $_SESSION['user_id'];

    $q = mysqli_query(
        $conn,
        "SELECT dark_mode
         FROM user_settings
         WHERE user_id='$uid'"
    );

    if($q && mysqli_num_rows($q) > 0)
    {
        $d = mysqli_fetch_assoc($q);
        $darkMode = $d['dark_mode'] ?? 0;
    }
}



/* CART COUNT */
$cartCount = 0;

if(isset($_SESSION['user_id']))
{
    $uid = $_SESSION['user_id'];

    $countQuery = mysqli_query(
        $conn,
        "SELECT COALESCE(SUM(quantity),0) AS total
         FROM cart
         WHERE user_id='$uid'"
    );

    if($countQuery)
    {
        $countData = mysqli_fetch_assoc($countQuery);
        $cartCount = $countData['total'];
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<title>Modern Fashion Store</title>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>
<style>

.brand-logo{
    font-size:2rem;
    font-weight:700;
    letter-spacing:2px;
    color:#111;
}

.brand-logo i{
    color:#d4af37;
    margin-right:8px;
}

.brand-logo span{
    color:#d4af37;
}

.navbar{
    background:#fff !important;
}

.nav-link{
    font-weight:500;
}

.admin-link{
    color:#dc3545 !important;
    font-weight:700;
}
</style>

<body>
    

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <!-- BRAND -->
        <a href="landing.php "
           class="navbar-brand text-decoration-none d-flex fs-2 align-items-center brand-logo">
            <i class="fa-solid fa-gem fs-2 d-flex"></i>
            VE<span class="text">L</span>ORA

        </a>

        <!-- MOBILE TOGGLE -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMenu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse"
             id="navMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="landing.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products.php">
                        Products
                    </a>
                </li>
                
 <!-- ADMIN PANEL -->

                <?php if(
                    isset($_SESSION['role']) &&
                    $_SESSION['role'] == 'admin'
                ) { ?>

                <li class="nav-item">

                    <a class="nav-link admin-link"
                       href="admin/dashboard.php">

                        Admin Panel

                    </a>

                </li>

                <?php } ?>

                <!-- ACCOUNT DROPDOWN -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        My Account

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item"
                               href="profile.php">
                                Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="wishlist.php">
                                Wishlist
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="settings.php">
                                Setting 
                            </a>
                        </li>
                        
                         <li>
                            <a class="dropdown-item"
                               href="my_orders.php">
                                My Orders
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="settings.php">
                                Settings
                            </a>
                        </li>
                        

                    </ul>

                </li>

                <!-- CART -->
                <li class="nav-item">

                    <a class="nav-link position-relative"
                       href="cart.php">

                        Cart

                        <?php if($cartCount > 0){ ?>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            <?php echo $cartCount; ?>

                        </span>

                        <?php } ?>

                    </a>

                </li>

                <?php if(isset($_SESSION['user_id'])) { ?>

                    <li class="nav-item">

                        <span class="nav-link fw-semibold">

                            Hi,
                            <?php echo $_SESSION['user_name']; ?>

                        </span>

                    </li>

                    <li class="nav-item">

                        <a class="btn btn-outline-dark ms-lg-2"
                           href="logout.php">

                            Logout

                        </a>

                    </li>

                <?php } else { ?>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="login.php">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="btn btn-dark ms-lg-2"
                           href="register.php">

                            Register

                        </a>

                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>

</body>
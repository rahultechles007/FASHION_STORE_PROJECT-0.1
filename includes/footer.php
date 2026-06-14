<footer class="bg-white border-top mt-5">

    <div class="container py-5">

        <div class="row">

            <!-- BRAND -->
            <div class="col-lg-4 mb-4">

                <h4 class="fw-bold">
                    VELORA
                </h4>

                <p class="text-muted">
                    Premium fashion for men, women, and kids.
                    Discover modern styles curated for every occasion.
                </p>

            </div>

            <!-- QUICK LINKS -->
            <div class="col-lg-2 col-md-4 mb-4">

                <h6 class="fw-bold mb-3">
                    Quick Links
                </h6>

                <ul class="list-unstyled">

                    <li>
                        <a href="landing.php"
                           class="text-decoration-none text-muted">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="products.php"
                           class="text-decoration-none text-muted">
                            Products
                        </a>
                    </li>

                    <li>
                        <a href="wishlist.php"
                           class="text-decoration-none text-muted">
                            Wishlist
                        </a>
                    </li>

                    <li>
                        <a href="cart.php"
                           class="text-decoration-none text-muted">
                            Cart
                        </a>
                    </li>

                </ul>

            </div>

            <!-- INFORMATION -->
            <div class="col-lg-3 col-md-4 mb-4">

                <h6 class="fw-bold mb-3">
                    Information
                </h6>

                <ul class="list-unstyled">

                    <li>
                        <a href="about.php"
                           class="text-decoration-none text-muted">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="features.php"
                           class="text-decoration-none text-muted">
                            Features
                        </a>
                    </li>

                    <li>
                        <a href="privacy.php"
                           class="text-decoration-none text-muted">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="terms.php"
                           class="text-decoration-none text-muted">
                            Terms & Conditions
                        </a>
                    </li>

                </ul>

            </div>

            <!-- CONTACT -->
            <div class="col-lg-3 col-md-4 mb-4">

                <h6 class="fw-bold mb-3">
                    Contact
                </h6>

                <p class="text-muted mb-1">
                    support@velora.com
                </p>

                <p class="text-muted mb-1">
                    +91 98765 43210
                </p>

                <p class="text-muted">
                    Odisha, India
                </p>

            </div>

        </div>

    </div>

    <!-- COPYRIGHT -->

    <div class="border-top py-3">

        <div class="container text-center">

            <small class="text-muted">

                © 2026 VELORA Fashion Store.
                All Rights Reserved.

            </small>

        </div>

    </div>

</footer>

<!-- MOBILE BOTTOM NAVIGATION -->

<nav class="mobile-bottom-nav d-md-none">

    <a href="landing.php" class="mobile-nav-item">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
    </a>

    <a href="products.php" class="mobile-nav-item">
        <i class="fa-solid fa-bag-shopping"></i>
        <span>Shop</span>
    </a>

    <a href="orders.php" class="mobile-nav-item">
        <i class="fa-solid fa-box"></i>
        <span>Orders</span>
    </a>

    <a href="wishlist.php" class="mobile-nav-item">
        <i class="fa-solid fa-heart"></i>
        <span>Wishlist</span>
    </a>

    <a href="profile.php" class="mobile-nav-item">
        <i class="fa-solid fa-user"></i>
        <span>Profile</span>
    </a>

</nav>

<style>

/* MOBILE BOTTOM NAV */

.mobile-bottom-nav{
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#ffffff;
    border-top:1px solid #e5e5e5;
    display:flex;
    justify-content:space-around;
    align-items:center;
    padding:10px 0;
    z-index:9999;
    box-shadow:0 -2px 10px rgba(0,0,0,.08);
}

.mobile-nav-item{
    text-decoration:none;
    color:#555;
    display:flex;
    flex-direction:column;
    align-items:center;
    font-size:12px;
}

.mobile-nav-item i{
    font-size:18px;
    margin-bottom:3px;
}

.mobile-nav-item:hover{
    color:#d4af37;
}

@media(min-width:768px){

    .mobile-bottom-nav{
        display:none;
    }

}

@media(max-width:767px){

    body{
        padding-bottom:75px;
    }

}

</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>
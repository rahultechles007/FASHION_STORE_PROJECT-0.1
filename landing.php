<?php 
include("config/db.php");      // MUST BE FIRST
include("includes/header.php"); // SECOND?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Icons (for modern UI feel) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .category-card {
            transition: 0.3s;
            border-radius: 12px;
        }

        .category-card:hover {
            transform: translateY(-5px);
            background: #f8f9fa;
        }

        .product-card:hover {
            transform: scale(1.03);
            transition: 0.3s;
        }

        .badge-sale {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    

<!-- ========================= HERO SLIDER (NEW) ========================= -->
<!-- HERO SLIDER -->
<section class="container mt-4">

    <div id="heroCarousel"
         class="carousel slide shadow rounded overflow-hidden"
         data-bs-ride="carousel">

        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">

                <img src="assets/images/slider1.jpg"
                     class="d-block w-100 slider-img"
                     alt="Luxury Fashion">

                <div class="carousel-caption">
                    <h1 class="fw-bold">Elevate Your Style</h1>
                    <p>Premium fashion for men, women & kids</p>
                    <a href="products.php"
                       class="btn btn-warning">
                        Shop Now
                    </a>
                </div>

            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">

                <img src="assets/images/slider2.jpg"
                     class="d-block w-100 slider-img"
                     alt="New Arrivals">

                <div class="carousel-caption">
                    <h1 class="fw-bold">New Arrivals</h1>
                    <p>Fresh fashion collection just arrived</p>
                    <a href="products.php"
                       class="btn btn-warning">
                        Shop Now
                    </a>
                </div>

            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">

                <img src="assets/images/slider3.jpg"
                     class="d-block w-100 slider-img"
                     alt="Mega Sale">

                <div class="carousel-caption">
                    <h1 class="fw-bold">Big Sale Live</h1>
                    <p>Up to 50% OFF limited time</p>
                    <a href="products.php"
                       class="btn btn-warning">
                        Shop Now
                    </a>
                </div>

            </div>

        </div>

        <!-- Controls -->
        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
                type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

</section>
<!-- ========================= CATEGORY SECTION (UPGRADED  ========================= -->
<section class="container py-5">

    <h2 class="text-center fw-bold mb-4">Shop by Category</h2>

    <div class="row g-4 text-center">

        <div class="col-md-4">
            <a href="products.php?category=men" class="text-decoration-none text-dark">
                <div class="card p-4 shadow-sm category-card">
                    <i class="bi bi-person fs-1"></i>
                    <h4 class="mt-2">Men</h4>
                    <p class="text-muted">Stylish outfits</p>
                </div>
            </a>
        </div> 

        <div class="col-md-4">
            <a href="products.php?category=women" class="text-decoration-none text-dark">
                <div class="card p-4 shadow-sm category-card">
                    <i class="bi bi-person-standing-dress fs-1"></i>
                    <h4 class="mt-2">Women</h4>
                    <p class="text-muted">Elegant fashion</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="products.php?category=kids" class="text-decoration-none text-dark">
                <div class="card p-4 shadow-sm category-card">
                    <i class="bi bi-balloon fs-1"></i>
                    <h4 class="mt-2">Kids</h4>
                    <p class="text-muted">Comfort wear</p>
                </div>
            </a>
        </div>

    </div>

</section>

<!-- =========================  SALE BANNER (UPGRADED)========================= -->
<section class="container py-5">

    <div class="bg-dark text-white text-center p-5 rounded position-relative">

        <h2 class="fw-bold"> Mega Sale is Live!</h2>
        <p>Up to 50% OFF on selected fashion items</p>

        <a href="products.php" class="btn btn-warning btn-lg mt-2">
            Grab Deals
        </a>

    </div>

</section>

<!-- ========================== FEATURED PRODUCTS ============================== -->
<section class="container py-5">

    <h2 class="text-center fw-bold mb-4">Featured Products</h2>

    <div class="row g-3">

        <?php
        $featured = mysqli_query($conn,
        "SELECT * FROM products ORDER BY product_id DESC LIMIT 8");

        while($row = mysqli_fetch_assoc($featured))
        {
        ?>

        <div class="col-6 col-md-3">

            <div class="card border-0 shadow-sm product-card position-relative h-100">

                <!-- SALE BADGE -->
                <span class="badge-sale">New</span>

                <!-- IMAGE -->
                <img src="assets/images/products/<?php echo $row['image']; ?>"
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                <div class="card-body text-center">

                    <!-- NAME -->
                    <h6 class="fw-bold mb-1">
                        <?php echo $row['product_name']; ?>
                    </h6>

                    <!-- RATING -->
                    <div class="text-warning small mb-1">
                        ★★★★☆ (4.5)
                    </div>

                    <!-- PRICE -->
                    <p class="fw-bold mb-2">
                        ₹<?php echo $row['price']; ?>
                    </p>

                    <!-- VIEW BUTTON -->
                    <a href="product_details.php?id=<?php echo $row['product_id']; ?>"
                       class="btn btn-outline-dark btn-sm w-100 mb-2">
                        View
                    </a>

                    <!-- WISHLIST BUTTON -->
                    <a href="wishlist_add.php?id=<?php echo $row['product_id']; ?>"
                       class="btn btn-outline-danger btn-sm w-100 mb-2">
                        Wishlist
                    </a>

                    <!-- ADD TO CART AJAX BUTTON -->
                    <button class="btn btn-success btn-sm w-100 add-to-cart"
                            data-id="<?php echo $row['product_id']; ?>">
                        Add to Cart
                    </button>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

<!-- ========================= CTA SECTION ========================= -->
<section class="container py-5">

    <div class="text-center p-5 bg-light rounded shadow-sm">

        <h3 class="fw-bold">Start Shopping Today</h3>
        <p class="text-muted">Best fashion deals delivered to your doorstep</p>

        <a href="products.php" class="btn btn-dark btn-lg">
            Explore Now
        </a>

    </div>

</section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    $(".add-to-cart").click(function(){

        var product_id = $(this).data("id");

        $.ajax({
            url: "add_to_cart.php",
            type: "POST",
            data: {
                product_id: product_id,
                quantity: 1
            },
            success: function(response)
            {
                if(response.status === "success")
                {
                    alert(response.message);
                }
                else
                {
                    alert(response.message);
                    window.location.href = "login.php";
                }
            }
        });

    });

});
</script>
<?php include("includes/footer.php"); ?>


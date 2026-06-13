<?php

include("config/db.php");
include("includes/header.php");

/* =========================
   BASE QUERY
========================= */
$sql = "SELECT * FROM products WHERE 1=1";

/* =========================
   SEARCH FILTER
========================= */
if(!empty($_GET['search']))
{
    $search = $_GET['search'];
    $sql .= " AND product_name LIKE '%$search%'";
}

/* =========================
   PRICE FILTER
========================= */
if(!empty($_GET['min_price']) && !empty($_GET['max_price']))
{
    $min = $_GET['min_price'];
    $max = $_GET['max_price'];

    $sql .= " AND price BETWEEN $min AND $max";
}

/* =========================
   STOCK FILTER
========================= */
if(isset($_GET['stock']))
{
    $sql .= " AND stock > 0";
}

/* =========================
   SORT FILTER
========================= */
if(!empty($_GET['sort']))
{
    if($_GET['sort'] == "low")
    {
        $sql .= " ORDER BY price ASC";
    }
    elseif($_GET['sort'] == "high")
    {
        $sql .= " ORDER BY price DESC";
    }
}
else
{
    $sql .= " ORDER BY product_id DESC";
}

/* =========================
   FINAL QUERY EXECUTION
========================= */
$products = mysqli_query($conn, $sql);

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Our Collection</h1>
        <p class="text-secondary">Discover premium fashion products.</p>
    </div>

    <!-- =========================
         SEARCH / FILTER FORM
    ========================== -->
    <form method="GET" class="mb-4">

        <div class="row g-2">

            <div class="col-md-4">
                <input type="text" name="search"
                       class="form-control"
                       placeholder="Search products..."
                       value="<?php echo $_GET['search'] ?? ''; ?>">
            </div>

            <div class="col-md-2">
                <input type="number" name="min_price"
                       class="form-control"
                       placeholder="Min Price"
                       value="<?php echo $_GET['min_price'] ?? ''; ?>">
            </div>

            <div class="col-md-2">
                <input type="number" name="max_price"
                       class="form-control"
                       placeholder="Max Price"
                       value="<?php echo $_GET['max_price'] ?? ''; ?>">
            </div>

            <div class="col-md-2">
                <select name="sort" class="form-control">
                    <option value="">Sort</option>
                    <option value="low" <?php if(($_GET['sort'] ?? '') == 'low') echo 'selected'; ?>>
                        Low → High
                    </option>
                    <option value="high" <?php if(($_GET['sort'] ?? '') == 'high') echo 'selected'; ?>>
                        High → Low
                    </option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-check">
                    <input type="checkbox" name="stock"
                        <?php if(isset($_GET['stock'])) echo "checked"; ?>>
                    In Stock
                </label>
            </div>

        </div>

        <button class="btn btn-primary mt-2">
            Filter
        </button>

    </form>

    <!-- =========================
         PRODUCTS GRID
    ========================== -->
    <div class="row g-4">

        <?php if(mysqli_num_rows($products) > 0) { ?>

            <?php while($product = mysqli_fetch_assoc($products)) { ?>
                
                <div class="col-lg-3 col-md-6">

                    <div class="card h-100 shadow-sm border-0 product-card">

                        <img
                            src="assets/images/products/<?php echo $product['image']; ?>"
                            class="card-img-top"
                            style="height:300px;object-fit:cover;"
                            alt="Product">

                        <div class="card-body">

                            <h5 class="fw-bold">
                                <?php echo $product['product_name']; ?>
                            </h5>

                            <p class="text-muted">
                                <?php echo $product['category']; ?>
                            </p>

                            <h5 class="text-warning">
                                ₹<?php echo number_format($product['price']); ?>
                            </h5>

                            <?php if($product['stock'] <= 0) { ?>
                                <span class="badge bg-danger">Out of Stock</span>
                            <?php } else { ?>
                                <span class="badge bg-success">In Stock</span>
                            <?php } ?>

                           <a href="product_details.php?id=<?php echo $row['product_id']; ?>" class="btn btn-dark btn-sm w-100 mb-1">
    View
</a>

<a href="wishlist_add.php?id=<?php echo $row['product_id']; ?>"
   class="btn btn-outline-danger btn-sm w-100">
    Add to Wishlist
</a>
                            

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="text-center">
                <h5>No products found</h5>
            </div>

        <?php } ?>

    </div>

</div>

<?php include("includes/footer.php"); ?>
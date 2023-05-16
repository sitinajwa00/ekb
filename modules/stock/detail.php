<?php

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_admin.php';

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

$product = new ProductController();
$result = $product->getProductDetails($_GET['product_id']);
$detail = $result[0];

if (isset($_POST['submit'])) {
    $addProd = new ProductController();
    $addProd->addQty($_GET['product_id'], (int)$_POST['qty']);

    echo '<script>
        alert("Successfully add stock quantity.");
        window.location.href = "'.APP_URL.'?module=stock";
    </script>';
}

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="product_id" class="form-control" value="<?php echo $_GET['product_id'] ?>" disabled>
                    <div class="mb-3">
                        <label for="" class="form-label">Product</label>
                        <input type="text" class="form-control" value="<?php echo $detail['productName'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Current Quantity</label>
                        <input type="text" class="form-control" value="<?php echo $detail['productQty'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Add Quantity</label>
                        <input type="number" name="qty" class="form-control" placeholder="0" min="0">
                    </div>
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
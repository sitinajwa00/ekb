<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';
require INCL_PATH . 'cart.inc.php';

$product = new ProductController();
$productList = $product->displayAllProducts();

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav.php';

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-warning active">Home</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="text-center">
            <h3>Our Product</h3>
            <hr>
        </div>
        <div class="row p-3">
            <?php foreach ($productList as $prod) {?>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body card-product pb-0" style="cursor:pointer;" data-id="<?php echo $prod['productID'] ?>">
                        <div class="text-center mb-2">
                            <img 
                                src="<?php echo ($prod['productImage']!='' ? IMG_URL . $prod['productImage'] : ASSET_URL . '/images/default_image.jpg') ?>" 
                                alt="" 
                                style="height:200px; width:200px;object-fit:cover;"
                            >
                        </div>
                        <p class="text-center font-weight-light"><?php echo $prod['productName'] ?></p>
                    </div>
                    <div class="card-body pt-0">
                        <table class="col-12 mb-1">
                            <tr>
                                <td>Price <small>(Postage)</small>:</td>
                                <td class="text-end">RM <?php echo $prod['productPricePos'] ?></td>
                            </tr>
                            <tr>
                                <td>Price <small>(COD)</small>:</td>
                                <td class="text-end">RM <?php echo $prod['productPriceCOD'] ?></td>
                            </tr>
                        </table>
                        <div>
                            <button class="btn btn-dark w-100" onclick="window.location.href='<?php echo APP_URL ?>?module=auth&action=login'">Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
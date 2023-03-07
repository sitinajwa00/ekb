<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

$product = new ProductController();
$result = $product->displayProduct($_GET['product_id']);
$detail = $result[0];

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

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
                <div class="row">
                <div class="col-4">
                    <img src="<?php echo IMG_URL . $detail['productImage'] ?>" class="w-100" alt="">
                </div>
                <div class="col-8">
                    <h4><?php echo $detail['productName'] ?></h4>
                    <!-- Product Price -->
                    <div class="mb-2">
                        <div class="border-top border-bottom bg-light ps-2">
                            PRODUCT PRICE
                        </div>
                        <div class="row col-12 ps-2">
                            <div class="col-2 text-secondary">Price <small>(Delivery)</small>:</div>
                            <div class="col-10">RM <?php echo $detail['productPriceDvry'] ?></div>
                        </div>
                        <div class="row col-12 ps-2">
                            <div class="col-2 text-secondary">Price <small>(COD)</small>:</div>
                            <div class="col-10">RM <?php echo $detail['productPriceCOD'] ?></div>
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="mb-2">
                        <div class="border-top border-bottom bg-light ps-2">
                            PRODUCT DESCRIPTION
                        </div>
                        <span class="ps-2"><?php echo $detail['productDesc'] ?></span>
                    </div>
                    <!-- Product Weight -->
                    <div class="mb-2">
                        <div class="border-top border-bottom bg-light ps-2">
                            PRODUCT WEIGHT
                        </div>
                        <span class="ps-2"><?php echo ($detail['productWeight']=='500' ? $detail['productWeight'].'g' : ($detail['productWeight']/1000) . 'kg') ?></span>
                    </div>

                    <!-- Order Detail -->
                    <div class="border p-2">
                        <div class="row col-12 mb-3 align-items-center">
                            <label for="" class="label-form col-2">Quantity:</label>
                        <div class="col-2">
                            <input type="number" class="form-control" min="0" value="0"> 
                        </div>
                        <div class="col-4">
                            <small>## items available</small>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-2">
                            <label for="" class="label-form">Delivery Type:</label>
                        </div>
                        <div class="mb-3 col-8">
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery_type" id="radio1" value="delivery" checked>
                            <label class="form-check-label" for="radio1">
                                Delivery
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery_type" value="cod" id="radio2">
                            <label class="form-check-label" for="radio2">
                                Cash On Delivery
                            </label>
                            </div>
                        </div>
                        </div>
                        
                        <span class="btn btn-dark">Add to cart</span>
                    </div>
                        
                </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
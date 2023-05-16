<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';
require INCL_PATH . 'cart.inc.php';

$product = new ProductController();
$result = $product->getProductDetails($_GET['product_id']);
$detail = $result[0];

$cart = new CartController();
$cartList = $cart->displayAllCartsByUser($_SESSION['user']['id']);
$cartCount = count($cartList);

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
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=order&action=product">Product List</a></li>
                        <li class="breadcrumb-item text-warning active">Product Detail</li>
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
                    <img src="<?php echo ($detail['productImage']!='' ? IMG_URL . $detail['productImage'] : ASSET_URL . '/images/default_image.jpg') ?>" class="w-100" alt="">
                </div>
                <div class="col-8">
                    <h4><?php echo $detail['productName'] ?></h4>
                    <!-- Product Price -->
                    <div class="mb-2">
                        <div class="border-top border-bottom bg-light ps-2">
                            PRODUCT PRICE
                        </div>
                        <div class="row col-12 ps-2">
                            <div class="col-2 text-secondary">Price <small>(Postage)</small>:</div>
                            <div class="col-10">RM <?php echo $detail['productPricePos'] ?></div>
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
                    <form class="border p-2" action="<?php echo APP_URL.'?module=shopping&action=submit&product_id='.$_GET['product_id'] ?>" method="post">
                        <input type="hidden" name="product_name" value="<?php echo $detail['productName'] ?>">
                        <div class="row col-12 mb-3 align-items-center">
                            <label for="" class="label-form col-2">Quantity:</label>
                            <div class="col-2">
                                <input type="number" name="order_qty" class="form-control" min="0" value="1"> 
                            </div>
                            <div class="col-4">
                                <small class="text-danger"><?php echo ($detail['productQty'] <= 10 ? $detail['productQty'] . ' item(s) available' : '') ?></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label for="" class="label-form">Delivery Type:</label>
                            </div>
                            <div class="mb-3 col-8">
                                <div class="form-check" <?php echo ($detail['is_pos'] == 0 ? 'hidden' : '') ?>>
                                    <input class="form-check-input" type="radio" name="delivery_type" id="radio1" value="pos" checked>
                                    <label class="form-check-label" for="radio1">
                                        Postage
                                    </label>
                                </div>
                                <div class="form-check" <?php echo ($detail['is_cod'] == 0 ? 'hidden' : '') ?>>
                                    <input class="form-check-input" type="radio" name="delivery_type" value="cod" id="radio2">
                                    <label class="form-check-label" for="radio2">
                                        Cash On Delivery
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="unit_price" data-price-cod="<?php echo $detail['productPriceCOD'] ?>" data-price-pos="<?php echo $detail['productPricePos'] ?>" value="<?php echo $detail['productPricePos'] ?>">
                        </div>
                        
                        <button type="submit" name="add_to_cart" class="btn btn-dark">Add to cart</button>
                    </form>
                        
                </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
    $(document).ready(function(){
        $('.my-cart-badge').html('<?php echo $cartCount; ?>');
    });
    
    $(document).on('click', '#radio1', function(){
        $('input[name="unit_price"]').val($('input[name="unit_price"]').attr('data-price-pos'));
    });

    $(document).on('click', '#radio2', function(){
        $('input[name="unit_price"]').val($('input[name="unit_price"]').attr('data-price-cod'));
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
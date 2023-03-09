<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';
require INCL_PATH . 'cart.inc.php';

$product = new ProductController();
$productList = $product->displayAllProducts();

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
                        <li class="breadcrumb-item text-warning active">Product List</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
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
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="number" class="form-control" name="" min="0" value="0">
                            </div>
                            <div class="col-8">
                                <select name="" id="" class="form-select">
                                    <option value="pos" <?php echo ($prod['is_pos']!='1' ? 'hidden disabled' : '') ?>>Postage</option>
                                    <option value="cod" <?php echo ($prod['is_cod']!='1' ? 'hidden disabled' : '') ?>>COD</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <span class="btn btn-dark w-100">Add to cart</span>
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

<script>
    $(document).ready(function(){
        $('.card-product').on('click', function(){
            var product_id = $(this).attr('data-id');

            $(location).attr('href', '<?php echo APP_URL ?>?module=order&action=product_detail&product_id='+product_id);
        });

        $('.my-cart-badge').html('<?php echo $cartCount ?>');
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
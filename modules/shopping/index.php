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
                                <input type="number" class="form-control qty" name="" min="1" value="1">
                            </div>
                            <div class="col-8">
                                <select name="" id="" class="form-select type">
                                    <option value="pos" <?php echo ($prod['is_pos']!='1' ? 'hidden disabled' : '') ?>>Postage</option>
                                    <option value="cod" <?php echo ($prod['is_cod']!='1' ? 'hidden disabled' : '') ?>>COD</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <?php 
                            echo '<span data-id="'.$prod['productID'].'" data-name="'.$prod['productName'].'" data-qty="1" data-type="'.($prod['is_pos']=='1' ? 'pos' : 'cod').'" data-price-pos="'.$prod['productPricePos'].'" data-price-cod="'.$prod['productPriceCOD'].'" class="btn btn-dark w-100 add_to_cart_btn">Add To Cart</span>'
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div hidden>
            <form action="<?php echo APP_URL . '?module=shopping&action=submit' ?>" method="post">
                productID: <input type="text" name="product_id" value="">
                productName: <input type="text" name="product_name" value="">
                delivery: <input type="text" name="delivery_type" value="">
                price: <input type="text" name="unit_price" value="">
                qty: <input type="text" name="order_qty" value=""> 
                <button type="submit" name="add_to_cart">Submit</button>   
            </form>
            
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
    $(document).ready(function(){
        $('.card-product').on('click', function(){
            var product_id = $(this).attr('data-id');

            $(location).attr('href', '<?php echo APP_URL ?>?module=shopping&action=product_detail&product_id='+product_id);
        });

        // Set default value in qty form
        $('.qty').val('1');
        $('.type').val($('.type option:first').val());

        // My Cart Count
        var cart_count = <?php echo $cartCount; ?>;
        $('.my-cart-badge').html(cart_count);
        if (cart_count > 0)
            $('.my-cart-badge-2').html('My Cart&emsp;<span class="badge badge-warning">'+cart_count+'</span>');

        // Add To Cart
        $('.qty').on('change', function() {
            $(this).closest('.row').next().find('.add_to_cart_btn').attr('data-qty', $(this).val());
        });

        $('.type').on('change', function() {
            $(this).closest('.row').next().find('.add_to_cart_btn').attr('data-type', $(this).val());
        });

        $('.add_to_cart_btn').on('mouseenter', function() {
            var product_id = $(this).attr('data-id');
            var product_name = $(this).attr('data-name');
            var delivery_type = $(this).attr('data-type');
            var unit_price = (delivery_type=='pos' ? $(this).attr('data-price-pos') : $(this).attr('data-price-cod'));
            var order_qty = $(this).attr('data-qty');

            $('input[name="product_id"]').attr('value',product_id );
            $('input[name="product_name"]').attr('value', product_name);
            $('input[name="delivery_type"]').attr('value', delivery_type);
            $('input[name="unit_price"]').attr('value', unit_price);
            $('input[name="order_qty"]').attr('value', order_qty);
        });

        $('.add_to_cart_btn').on('click', function() {
            $('button[name="add_to_cart"]')[0].click();
        });
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
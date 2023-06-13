<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require INCL_PATH . 'cart.inc.php';

$user = new UserController();
$result = $user->getUserDetails($_SESSION['user']['id']);
$user_detail = $result[0];

$all_cart = new CartController();
$result = $all_cart->displayAllCartsByUser($_SESSION['user']['id']);
$cart_list = $result;
$cartCount = count($cart_list);

// Count the number for cod and postage
$count_cod = 0;
$count_pos = 0;

foreach ($cart_list as $val) {
    if ($val['delivery_type'] == 'cod')
        $count_cod++;
    else if ($val['delivery_type'] == 'pos')
        $count_pos++;
}

$_SESSION['cart']['cod'] = $count_cod;
$_SESSION['cart']['pos'] = $count_pos;

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

// Submit form for update quantity
if (isset($_POST['updateQty'])) {
    $cart_id = $_POST['cart_id'];
    $order_qty = $_POST['order_qty'];
    $unit_price = $_POST['unit_price'];
    $total_price = number_format($unit_price * $order_qty, 2);

    $updateQtyOrder = new CartController();
    $updateQtyOrder->editQty($cart_id, $order_qty, $total_price);

    echo '<script>
        window.location.href = "' .APP_URL. '?module=cart";
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
        <div class="row">
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr class="bg-secondary">
                                <th colspan="2" class="text-center">Product</th>
                                <th>Unit Price</th>
                                <th class="col-2">Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart_list as $val) {?>
                            <tr data-cart-id="<?php echo $val['cartID'] ?>" data-unit-price="<?php echo $val['unit_price'] ?>">
                                <td class="col-2"><img src="<?php echo IMG_URL . $val['productImage'] ?>" alt="" class="w-100"></td>
                                <td><?php echo $val['product_name'] ?><br><small><?php echo ($val['delivery_type']=='cod' ? 'COD' : 'Postage') ?></small></td>
                                <td data-price="<?php echo $val['unit_price'] ?>">RM<?php echo $val['unit_price'] ?></td>
                                <td><input type="number" name="" id="" class="form-control qty" min="0" value="<?php echo $val['order_qty'] ?>"></td>
                                <td>RM<?php echo $val['total_price'] ?></td>
                                <td><i class="fa-solid fa-trash" onclick="window.location.href='<?php echo APP_URL .'?module=cart&action=submit&cart_id='.$val['cartID']?>'"></i></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-end">
                      <a href="<?php echo APP_URL ?>?module=shopping"><span class="btn btn-warning">Add Order</span></a>  
                    </div>
                    
                </div>
                <form action="" method="post" hidden>
                    <input type="text" name="unit_price" value="">
                    <input type="text" name="order_qty" value="">
                    <input type="text" name="cart_id" value="">
                    <button type="submit" name="updateQty" class="btn update-qty">Update Qty</button>
                </form>
                <div class="col-4">
                    <div class="card">
                        <!-- Shipping Address -->
                        <div class="card-header bg-secondary text-light px-4 py-1"><i class="fa-solid fa-location-crosshairs"></i> Shipping Address</div>
                        <div class="card-body pt-1">
                          <span class="fw-bold"><small><?php echo $_SESSION['user']['name'] ?></small></span><br>
                          <span class="user-address"><small><?php echo $_SESSION['user']['address'] ?></small></span><br>
                          <span class="user-address"><small><?php echo $_SESSION['user']['phonenum'] ?></small></span><br>
                          <!-- <span class="text-warning edit-address" style="cursor:pointer;"><small><i class="fa-regular fa-pen-to-square"></i> Edit Address</span></small> -->
                        </div>
                        <!-- Price Details -->
                        <div class="bg-secondary text-light px-4 py-1"><i class="fa-solid fa-dollar-sign"></i> Price Details</div>
                        
                        <div class="card-body pt-1">
                            <?php $subtotal = 0; ?>
                            <div class="cod-price-details" <?php echo ($count_cod == 0 ? 'hidden' : '') ?>>
                                <span class="badge badge-primary">COD</span>
                                <?php foreach ($cart_list as $value) {?>
                                    <?php if ($value['delivery_type'] == 'cod') {?>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div><?php echo $value['order_qty'] . ' ' . $value['product_name'] ?></div>
                                        <div><?php echo $value['total_price'] ?></div>
                                    </div>
                                    <?php $subtotal += $value['total_price'] ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="pos-price-details" <?php echo ($count_pos == 0 ? 'hidden' : '') ?>>
                                <span class="badge badge-primary">Postage</span>
                                <?php foreach ($cart_list as $value) {?>
                                    <?php if ($value['delivery_type'] == 'pos') {?>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div><?php echo $value['order_qty'] . ' ' . $value['product_name'] ?></div>
                                        <div><?php echo $value['total_price'] ?></div>
                                    </div>
                                    <?php $subtotal += $value['total_price'] ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <hr>
                            <div class="d-flex flex-row justify-content-between">
                                <div>Total</div>
                                <div>RM <?php echo number_format($subtotal, 2) ?></div>
                            </div>
                            <div class="mt-3 text-end">
                                <button class="btn btn-dark" onclick="window.location.href='<?php echo APP_URL ?>?module=cart&action=checkout'" <?php echo ($cartCount==0 ? 'disabled' : '') ?>>Check Out</button>
                            </div>
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
        // My Cart Badge
        var cart_count = <?php echo $cartCount; ?>;
        $('.my-cart-badge').html(cart_count);
        if (cart_count > 0)
            $('.my-cart-badge-2').html('My Cart&emsp;<span class="badge badge-warning">'+cart_count+'</span>');
    });

    $(document).on('change', '.qty', function(){
        var cart_id = $(this).closest('tr').attr('data-cart-id');
        var unit_price = $(this).closest('tr').attr('data-unit-price');
        var qty = $(this).val();
        $('input[name="cart_id"]').val(cart_id);
        $('input[name="order_qty"]').val(qty);
        $('input[name="unit_price"]').val(unit_price);
        $('.update-qty').trigger('click');
    });

    $(document).on('click', '.edit-address', function(){
        var old_address = $('.user-address').text;
        var new_address;
        var address = prompt("Shipping Address:", "");
        if (address == null || address == "") {
            new_address = old_address;
        } else {
            new_address = address;
        }
        $('.user-address').html(new_address);
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require INCL_PATH . 'cart.inc.php';

$user = new UserController();
$result = $user->displayUser($_SESSION['user']['id']);
$user_detail = $result[0];

$cart = new CartController();
$result = $cart->displayAllCartsByUser($_SESSION['user']['id']);
$cart_list = $result;
$cartCount = count($cart_list);

$state_arr = array(
    'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
    'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
);

foreach($state_arr as $i=>$val) {
    if ($user_detail['userState'] == $i) {
        $state = $val;
        break;
    }
}

$address = $user_detail['userAddress'] . ', ' . $user_detail['userPoscode'] . ', ' . $user_detail['userCity'] . ', ' . $state;

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

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
                                <th></th>
                                <th></th>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th class="col-2">Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart_list as $val) {?>
                            <tr data-cart-id="<?php echo $val['cartID'] ?>" data-unit-price="<?php echo $val['unit_price'] ?>">
                                <td data-product-id="<?php echo $val['productID'] ?>"><input type="checkbox" name="" id="" class="form-check-input"></td>
                                <td class="col-2"><img src="<?php echo IMG_URL . $val['productImage'] ?>" alt="" class="w-100"></td>
                                <td><?php echo $val['product_name'] ?><br><small><?php echo ($val['delivery_type']=='cod' ? 'COD' : 'Delivery') ?></small></td>
                                <td data-price="<?php echo $val['unit_price'] ?>">RM<?php echo $val['unit_price'] ?></td>
                                <td><input type="number" name="" id="" class="form-control qty" min="0" value="<?php echo $val['order_qty'] ?>"></td>
                                <td>RM<?php echo $val['total_price'] ?></td>
                                <td><i class="fa-solid fa-trash"></i></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-end">
                      <a href="<?php echo APP_URL ?>?module=order&action=product"><span class="btn btn-warning">Add Order</span></a>  
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
                          <span class="user-address"><small><?php echo $address ?></small></span><br>
                          <span class="text-warning edit-address" style="cursor:pointer;"><small><i class="fa-regular fa-pen-to-square"></i> Edit Address</span></small>
                        </div>
                        <!-- Price Details -->
                        <div class="bg-secondary text-light px-4 py-1"><i class="fa-solid fa-dollar-sign"></i> Price Details</div>
                        <div class="card-body pt-1">

                            <div class="fw-bold">COD</div>
                            <?php $cod_count = 0; ?>
                            <?php foreach ($cart_list as $value) {?>
                                <?php if ($value['delivery_type'] == 'cod') {?>
                                <div class="d-flex flex-row justify-content-between">
                                    <div><?php echo $value['product_name'] ?> x<?php echo $value['order_qty'] ?></div>
                                    <div><?php echo $value['total_price'] ?></div>
                                </div>
                                <?php $cod_count++; } ?>
                            <?php } ?>
                            <?php if($cod_count==0)  ?> <div>-</div>

                            <div class="fw-bold">Delivery</div>
                            <?php foreach ($cart_list as $value) {?>
                                <?php if ($value['delivery_type'] == 'delivery') {?>
                                <div class="d-flex flex-row justify-content-between">
                                    <div><?php echo $value['product_name'] ?> x<?php echo $value['order_qty'] ?></div>
                                    <div><?php echo $value['total_price'] ?></div>
                                </div>
                                <?php } ?>
                            <?php } ?>
                            <hr>
                            <div class="d-flex flex-row justify-content-between">
                                <div>Total</div>
                                <div>RM 29.00</div>
                            </div>
                            <div class="mt-3 text-end">
                                <span class="btn btn-dark">Check Out</span>
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
        $('.my-cart-badge').html('<?php echo $cartCount; ?>');
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
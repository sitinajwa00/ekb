<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require INCL_PATH . 'cart.inc.php';

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

$cart = new CartController();
$result_cart = $cart->displayAllCartsByUser($_SESSION['user']['id']);

// Quantity cart for cod and postage
$count_cod = $_SESSION['cart']['cod'];
$count_pos = $_SESSION['cart']['pos'];

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=order&action=cart">Cart</a></li>
                        <li class="breadcrumb-item text-warning">Order Information</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
            <span class="btn btn-dark confirm_btn mb-2">Confirm Order</span>
        <div class="row">
            <div class="col-6" <?php echo ($count_cod == 0 ? 'hidden' : '') ?>>
                <div class="card">
                    <div class="card-header border-bottom"><small>Payment Method: </small> <b>Cash on Delivery</b> </div>
                    <div class="card-body">
                        <table class="table">
                        <?php $total_cod = 0; ?>
                            <?php foreach ($result_cart as $val) {?>
                                <?php if ($val['delivery_type'] == 'cod') {?>
                                <tr>
                                    <td>x<?php echo $val['order_qty'] . ' ' . $val['product_name'] ?></td>
                                    <td class="text-end"><?php echo $val['total_price'] ?></td>
                                </tr>
                                <?php $total_cod += $val['total_price']; $_SESSION['payment']['cod'] =number_format($total_cod, 2);?>
                                <?php } ?>
                            <?php }?>
                            <tr>
                                <td class="text-end fw-bold">TOTAL</td>
                                <td class="text-end">RM <b><?php echo number_format($total_cod, 2) ?></b></td>
                            </tr>
                        </table>
                        <div class="alert alert-warning" role="alert">
                            Make payment in <b>Cash</b> to the courier when the item is delivered to you.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6" <?php echo ($count_pos == 0 ? 'hidden' : '') ?>>
            <div class="card">
                    <div class="card-header border-bottom"><small>Payment Method: </small> <b>Credit/Debit Card <i class="fa-brands fa-stripe"></i></b> </div>
                    <div class="card-body">
                        <table class="table">
                        <?php $total_pos = 0; ?>
                            <?php foreach ($result_cart as $val) {?>
                                <?php if ($val['delivery_type'] == 'pos') {?>
                                <tr>
                                    <td>x<?php echo $val['order_qty'] . ' ' . $val['product_name'] ?></td>
                                    <td class="text-end"><?php echo $val['total_price'] ?></td>
                                </tr>
                                <?php $total_pos += $val['total_price']; $_SESSION['payment']['amount'] =number_format($total_pos, 2);?>
                                <?php } ?>
                            <?php }?>
                            <tr>
                                <td class="text-end fw-bold">TOTAL</td>
                                <td class="text-end">RM <b><?php echo number_format($total_pos, 2) ?></b></td>
                            </tr>
                        </table>
                        <!-- <div class="text-end">
                            <span class="btn btn-dark" onclick="window.location.href='<?php echo APP_URL ?>?module=payment'">Make Payment</span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
    $(document).on('click', '.confirm_btn', function() {
        var count_pos = <?php echo $count_pos ?>;

        if (count_pos > 0) {
            $(location).attr('href', '<?php echo APP_URL ?>?module=payment');
        } else {
            $(location).attr('href', '<?php echo APP_URL ?>?module=cart&action=submit&response=yes');
        }
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
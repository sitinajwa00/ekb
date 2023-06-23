<?php

if (!isset($_SESSION['login'])) {
    header('Location: ' . APP_URL . '?module=auth&action=login');
}

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'cart.inc.php';
require INCL_PATH . 'order.inc.php';

$cart = new CartController();
$cartList = $cart->displayAllCartsByUser($_SESSION['user']['id']);
$cartCount = count($cartList);

$order = new OrderController();
$detail_order = $order->displayAllOrders($_SESSION['user']['id']);

$pending_order = 0;
foreach ($detail_order as $detail) {
    if ($detail['orderStatus'] == 'Pending')
        $pending_order++;
}

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

// Date
$day = date('D');
$date = date('M, d');
$year = date('Y');

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="row mb-4">
            <div class="col-3">
                <div class="card h-100">
                    <div class="card-header bg-primary text-light">
                        Today
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <tr>
                                <td rowspan="2"><h2><?php echo $day ?></h2></td>
                                <td><h6 class="pb-0 mb-0"><?php echo $date ?></h6></td>
                                <td rowspan="2" class="text-end text-secondary"><i class="fa-solid fa-calendar fa-3x"></i></td>
                            </tr>
                            <tr>
                                <td><h6><?php echo $year ?></h6></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card h-100">
                    <div class="card-header bg-info text-light">
                        My Cart
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <tr>
                                <td><h3 class="h3-mycart"></h3></td>
                                <td class="text-end text-secondary"><i class="fa-solid fa-cart-shopping fa-3x"></i></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card h-100">
                    <div class="card-header bg-success text-light">
                        Pending Order
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <tr>
                                <td><h3><?php echo $pending_order ?></h3></td>
                                <td class="text-end text-secondary"><i class="fa-solid fa-clock-rotate-left fa-3x"></i></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card h-100">
                    <div class="card-header bg-warning text-light">
                        My Profile
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <tr>
                                <td><a href="<?php echo APP_URL ?>?module=profile"><span class="btn btn-warning">View Profile</span></a></td>
                                <td class="text-end text-secondary"><i class="fa-solid fa-address-card fa-3x"></i></td>
                            </tr>
                        </table>
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
        var cart_count = <?php echo $cartCount; ?>;
        $('.my-cart-badge').html(cart_count);
        $('.h3-mycart').html(cart_count);
        if (cart_count > 0)
            $('.my-cart-badge-2').html('My Cart&emsp;<span class="badge badge-warning">'+cart_count+'</span>');
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
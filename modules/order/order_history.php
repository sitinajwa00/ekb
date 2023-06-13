<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'order.inc.php';
require INCL_PATH . 'cart.inc.php';

$order = new OrderController();
$order_result = $order->displayAllOrders($_SESSION['user']['id']);

$all_cart = new CartController();
$result = $all_cart->displayAllCartsByUser($_SESSION['user']['id']);
$cart_list = $result;
$cartCount = count($cart_list);

// echo json_encode($order_result);

$pending = 0; $processing = 0; $to_ship = 0; $out_for_delivery = 0; $complete = 0;

foreach ($order_result as $res) {
    switch($res['orderStatus']) {
        case 'Pending': 
            $pending++;
            break;
        case 'Processing': 
            $processing++;
            break;
        case 'To Ship': 
            $to_ship++;
            break;
        case 'Out For Delivery': 
            $out_for_delivery++;
            break;
        case 'Complete': 
            $complete++;
            break;
    }
}

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
                          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="order_history.html"><span class="text-primary">My Purchase</span></a></li>
                        </ol>
                      </nav>
                    </div>
                </nav>
            </div>

            <!-- Tab -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <!-- Tab: All -->
                <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                </li> -->
                <!-- Tab: Pending -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Pending&ensp;<?php echo ($pending > 0 ? '<span class="badge badge-warning">'.$pending.'</span>' : '') ?></button>
                </li>
                <!-- Tab: Processing -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing" type="button" role="tab" aria-controls="profile" aria-selected="false">Processing&ensp;<?php echo ($processing > 0 ? '<span class="badge badge-warning">'.$processing.'</span>' : '') ?></button>
                </li>
                <!-- Tab: Ship -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="ship-tab" data-bs-toggle="tab" data-bs-target="#ship" type="button" role="tab" aria-controls="ship" aria-selected="false">To Ship&ensp;<?php echo ($to_ship > 0 ? '<span class="badge badge-warning">'.$to_ship.'</span>' : '') ?></button>
                </li>
                <!-- Tab: Delivery -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">Out for Delivery&ensp;<?php echo ($out_for_delivery > 0 ? '<span class="badge badge-warning">'.$out_for_delivery.'</span>' : '') ?></button>
                </li>
                <!-- Tab: Complete -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="false">Complete</button>
                </li>
            </ul>
            <!-- Tab Content -->
            <div class="tab-content" id="myTabContent">
                <!-- Tab Content: All -->
                <!-- Tab Content: Pending -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="bg-white py-5 container">
                        <?php 
                        $count = 0;
                        foreach ($order_result as $val) {
                            if ($val['orderStatus']=='Pending') {
                                echo '
                                <div class="bg-light mb-4 border border-dark">
                                    <table class="table align-middle border border-secondary mb-0">
                                        <tbody data-id="'.$val['orderID'].'">
                                            <tr class="bg-dark text-light">
                                                <td class="fw-bold"><i>'.date('d M Y', strtotime($val['date'])).'</i></td>
                                                <td></td>
                                                <td class="fw-bold text-end">'.($val['deliveryType']=='COD' ? 'Cash On Delivery' : 'Postage').'</td>
                                            </tr>';
                                            $order_item = new OrderController();
                                            $item_list = $order_item->displayAllItemsByOrderID($val['orderID']);

                                            foreach ($item_list as $value) { 
                                                echo '<tr>
                                                    <td class="col-6">'.$value['product_name'].'</td>
                                                    <td>x'.$value['qty'].'</td>
                                                    <td class="text-end">'.$value['total_price'].'</td>
                                                </tr>';
                                            } 
                                            echo '<tr>
                                                <td colspan="3" class="text-end fw-bold">Total: RM '.$val['totalPrice'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                ';
                                $count++;
                            }
                        }
                        if ($count == 0)
                            echo '<div class="text-center"><span>No Order Available</span></div>';
                        ?>
                    </div>
                </div>
                <!-- Tab Content: Processing -->
                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                    <div class="bg-white py-5 container">
                    <?php 
                        $count = 0;
                        foreach ($order_result as $val) {
                            if ($val['orderStatus']=='Processing') {
                                echo '
                                <div class="bg-light mb-4 border border-dark">
                                    <table class="table align-middle border border-secondary mb-0">
                                        <tbody data-id="'.$val['orderID'].'">
                                            <tr class="bg-dark text-light">
                                                <td class="fw-bold"><i>'.date('d M Y', strtotime($val['date'])).'</i></td>
                                                <td></td>
                                                <td class="fw-bold text-end">'.($val['deliveryType']=='COD' ? 'Cash On Delivery' : 'Postage').'</td>
                                            </tr>';
                                            $order_item = new OrderController();
                                            $item_list = $order_item->displayAllItemsByOrderID($val['orderID']);

                                            foreach ($item_list as $value) { 
                                                echo '<tr>
                                                    <td class="col-6">'.$value['product_name'].'</td>
                                                    <td>x'.$value['qty'].'</td>
                                                    <td class="text-end">'.$value['total_price'].'</td>
                                                </tr>';
                                            } 
                                            echo '<tr>
                                                <td colspan="3" class="text-end fw-bold">Total: RM '.$val['totalPrice'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                ';
                                $count++;
                            }
                        }
                        if ($count == 0)
                            echo '<div class="text-center"><span>No Order Available</span></div>';
                        ?>
                    </div>
                </div>
                <!-- Tab Content: Shipping -->
                <div class="tab-pane fade" id="ship" role="tabpanel" aria-labelledby="ship-tab">
                    <div class="bg-white py-5 container">
                    <?php 
                        $count = 0;
                        foreach ($order_result as $val) {
                            if ($val['orderStatus']=='To Ship') {
                                echo '
                                <div class="bg-light mb-4 border border-dark">
                                    <table class="table align-middle border border-secondary mb-0">
                                        <tbody data-id="'.$val['orderID'].'">
                                            <tr class="bg-dark text-light">
                                                <td class="fw-bold"><i>'.date('d M Y', strtotime($val['date'])).'</i></td>
                                                <td></td>
                                                <td class="fw-bold text-end">'.($val['deliveryType']=='COD' ? 'Cash On Delivery' : 'Postage').'</td>
                                            </tr>';
                                            $order_item = new OrderController();
                                            $item_list = $order_item->displayAllItemsByOrderID($val['orderID']);

                                            foreach ($item_list as $value) { 
                                                echo '<tr>
                                                    <td class="col-6">'.$value['product_name'].'</td>
                                                    <td>x'.$value['qty'].'</td>
                                                    <td class="text-end">'.$value['total_price'].'</td>
                                                </tr>';
                                            } 
                                            echo '<tr>
                                                <td colspan="3" class="text-end fw-bold">Total: RM '.$val['totalPrice'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                ';
                                $count++;
                            }
                        }
                        if ($count == 0)
                            echo '<div class="text-center"><span>No Order Available</span></div>';
                        ?>
                    </div>
                </div>
                <!-- Tab Content: Delivery -->
                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                    <div class="bg-white py-5 container">
                    <?php 
                        $count = 0;
                        foreach ($order_result as $val) {
                            if ($val['orderStatus']=='Out For Delivery') {
                                echo '
                                <div class="bg-light mb-4 border border-dark">
                                    <table class="table align-middle border border-secondary mb-0">
                                        <tbody data-id="'.$val['orderID'].'">
                                            <tr class="bg-dark text-light">
                                                <td class="fw-bold"><i>'.date('d M Y', strtotime($val['date'])).'</i></td>
                                                <td></td>
                                                <td class="fw-bold text-end">'.($val['deliveryType']=='COD' ? 'Cash On Delivery' : 'Postage').'</td>
                                            </tr>';
                                            $order_item = new OrderController();
                                            $item_list = $order_item->displayAllItemsByOrderID($val['orderID']);

                                            foreach ($item_list as $value) { 
                                                echo '<tr>
                                                    <td class="col-6">'.$value['product_name'].'</td>
                                                    <td>x'.$value['qty'].'</td>
                                                    <td class="text-end">'.$value['total_price'].'</td>
                                                </tr>';
                                            } 
                                            echo '<tr>
                                                <td colspan="3" class="text-end fw-bold">Total: RM '.$val['totalPrice'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                ';
                                $count++;
                            }
                        }
                        if ($count == 0)
                            echo '<div class="text-center"><span>No Order Available</span></div>';
                        ?>
                    </div>
                </div>
                <!-- Tab Content: Complete -->
                <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                    <div class="bg-white py-5 container">
                    <?php 
                        $count = 0;
                        foreach ($order_result as $val) {
                            if ($val['orderStatus']=='Complete') {
                                echo '
                                <div class="bg-light mb-4 border border-dark">
                                    <table class="table align-middle border border-secondary mb-0">
                                        <tbody data-id="'.$val['orderID'].'">
                                            <tr class="bg-dark text-light">
                                                <td class="fw-bold"><i>'.date('d M Y', strtotime($val['date'])).'</i></td>
                                                <td></td>
                                                <td class="fw-bold text-end">'.($val['deliveryType']=='COD' ? 'Cash On Delivery' : 'Postage').'</td>
                                            </tr>';
                                            $order_item = new OrderController();
                                            $item_list = $order_item->displayAllItemsByOrderID($val['orderID']);

                                            foreach ($item_list as $value) { 
                                                echo '<tr>
                                                    <td class="col-6">'.$value['product_name'].'</td>
                                                    <td>x'.$value['qty'].'</td>
                                                    <td class="text-end">'.$value['total_price'].'</td>
                                                </tr>';
                                            } 
                                            echo '<tr>
                                                <td colspan="3" class="text-end fw-bold">Total: RM '.$val['totalPrice'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                ';
                                $count++;
                            }
                        }
                        if ($count == 0)
                            echo '<div class="text-center"><span>No Order Available</span></div>';
                        ?>
                    </div>
                </div>
            </div>
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
    </script>

<?php 
require ASSET_PATH . 'footer.php';
?>
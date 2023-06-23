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

$pending_order = [];
$processing_order = [];
$to_ship_order = [];
$out_for_delivery_order = [];
$complete_order = [];

// echo json_encode($order_result); exit;

foreach ($order_result as $val) {
    switch ($val['orderStatus']) {
        case "Pending":
            array_push($pending_order, $val);
            break;
        case "Processing":
            array_push($processing_order, $val);
            break;
        case "To Ship":
            array_push($to_ship_order, $val);
            break;
        case "Out For Delivery":
            array_push($out_for_delivery_order, $val);
            break;
        case "Complete":
            array_push($complete_order, $val);
            break;
    }
}

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
                          <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo APP_URL ?>?module=order&action=order_history"><span class="text-warning">Order History</span></a></li>
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
                        <div>
                            <table id="pendingOrder" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-secondary text-dark">
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th>Total Price (RM)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tab Content: Processing -->
                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                    <div class="bg-white py-5 container">
                        <div>
                            <table id="processingOrder" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-secondary text-dark">
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th>Total Price (RM)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tab Content: Shipping -->
                <div class="tab-pane fade" id="ship" role="tabpanel" aria-labelledby="ship-tab">
                    <div class="bg-white py-5 container">
                        <div>
                            <table id="toShip" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-secondary text-dark">
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th>Total Price (RM)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tab Content: Delivery -->
                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                    <div class="bg-white py-5 container">
                        <div>
                            <table id="outForDelivery" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-secondary text-dark">
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th>Total Price (RM)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tab Content: Complete -->
                <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                    <div class="bg-white py-5 container">
                        <div>
                            <table id="completeOrder" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-secondary text-dark">
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th>Total Price (RM)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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

        // Pending Table
        var p = $('#pendingOrder').DataTable({
            data: <?php echo json_encode($pending_order) ?>,
            src: 'data',
            columns: [
                { data: 'orderID' },
                { data: 'orderID' },
                { data: 'date' },
                { data: 'deliveryType' },
                { data: 'totalPrice' },
                { data: '' }
            ],
            columnDefs: [
                {
                targets: -1,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="d-flex flex-row justify-content-end">' +
                            '<a href="<?php echo APP_URL ?>?module=order&action=order_detail&order_id='+full['orderID']+'"><span class="btn btn-warning me-1">View</span></a>' +
                        '</div>'
                    );
                }
                }
            ],
            dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            });
        
        p.on('order.dt search.dt', function () {
            let i = 1;
 
            p.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    // Processing Table
    var pc = $('#processingOrder').DataTable({
            data: <?php echo json_encode($processing_order) ?>,
            src: 'data',
            columns: [
                { data: 'orderID' },
                { data: 'orderID' },
                { data: 'date' },
                { data: 'deliveryType' },
                { data: 'totalPrice' },
                { data: '' }
            ],
            columnDefs: [
                {
                targets: -1,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="d-flex flex-row justify-content-end">' +
                            '<a href="<?php echo APP_URL ?>?module=order&action=order_detail&order_id='+full['orderID']+'"><span class="btn btn-warning me-1">View</span></a>' +
                        '</div>'
                    );
                }
                }
            ],
            dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            });
        
        pc.on('order.dt search.dt', function () {
            let i = 1;
 
            pc.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    // To Ship Table
    var ts = $('#toShip').DataTable({
            data: <?php echo json_encode($to_ship_order) ?>,
            src: 'data',
            columns: [
                { data: 'orderID' },
                { data: 'orderID' },
                { data: 'date' },
                { data: 'deliveryType' },
                { data: 'totalPrice' },
                { data: '' }
            ],
            columnDefs: [
                {
                targets: -1,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="d-flex flex-row justify-content-end">' +
                            '<a href="<?php echo APP_URL ?>?module=order&action=order_detail&order_id='+full['orderID']+'"><span class="btn btn-warning me-1">View</span></a>' +
                        '</div>'
                    );
                }
                }
            ],
            dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            });
        
        ts.on('order.dt search.dt', function () {
            let i = 1;
 
            ts.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();

        // Out For Delivery Table
        var d = $('#outForDelivery').DataTable({
            data: <?php echo json_encode($out_for_delivery_order) ?>,
            src: 'data',
            columns: [
                { data: 'orderID' },
                { data: 'orderID' },
                { data: 'date' },
                { data: 'deliveryType' },
                { data: 'totalPrice' },
                { data: '' }
            ],
            columnDefs: [
                {
                targets: -1,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="d-flex flex-row justify-content-end">' +
                            '<a href="<?php echo APP_URL ?>?module=order&action=order_detail&order_id='+full['orderID']+'"><span class="btn btn-warning me-1">View</span></a>' +
                        '</div>'
                    );
                }
                }
            ],
            dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            });
        
        d.on('order.dt search.dt', function () {
            let i = 1;
 
            d.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();

    // Complete Table
    var c = $('#completeOrder').DataTable({
            data: <?php echo json_encode($complete_order) ?>,
            src: 'data',
            columns: [
                { data: 'orderID' },
                { data: 'orderID' },
                { data: 'date' },
                { data: 'deliveryType' },
                { data: 'totalPrice' },
                { data: '' }
            ],
            columnDefs: [
                {
                targets: -1,
                render: function(data, type, full, meta) {
                    return (
                        '<div class="d-flex flex-row justify-content-end">' +
                            '<a href="<?php echo APP_URL ?>?module=order&action=order_detail&order_id='+full['orderID']+'"><span class="btn btn-warning me-1">View</span></a>' +
                        '</div>'
                    );
                }
                }
            ],
            dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            });
        
    c.on('order.dt search.dt', function () {
            let i = 1;
 
            c.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    </script>

<?php 
require ASSET_PATH . 'footer.php';
?>
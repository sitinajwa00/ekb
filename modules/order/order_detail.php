<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require INCL_PATH . 'order.inc.php';

$user = new UserController();
$result = $user->getUserDetails($_SESSION['user']['id']);
$user_detail = $result[0];

$state_arr = array(
    'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
    'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
);

foreach ($state_arr as $i=>$state) {
    if ($user_detail['userState'] == $i)
        $user_state = $state;
}

$order = new OrderController();
$result = $order->getOrderDetails($_GET['order_id']);
$order_items = $order->displayAllItemsByOrderID($_GET['order_id']);
$order_detail = $result[0];

// $date=date_create("2013-03-15");
// echo date_format($date,"Y/m/d H:i:s");

$arrayDate = explode(" ", $order_detail['date']);
$date = date_create($arrayDate[0]);
$date_format = date_format($date, "M d, Y");

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-3">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=order&action=order_history">Order History</a></li>
                        <li class="breadcrumb-item text-warning active">Order Detail</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <h2>Order Number <span style="color:#d3920f">#<?php echo $_GET['order_id'] ?></span></h2>

        <div class="row">
            <div class="col-7">
                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th><h5>Items Summary</h5></th>
                                <th class="text-center"><h5>Qty</h5></th>
                                <th class="text-end"><h5>Price (RM)</h5></th>
                            </tr> 
                            <?php foreach ($order_items as $item) {?>
                            <tr>
                                <td><?php echo $item['product_name'] ?></td>
                                <td class="text-center"><?php echo $item['qty'] ?></td>
                                <td class="text-end"><?php echo $item['total_price'] ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="2"><h5>Customer Details</h5></th>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <td class="text-end"><?php echo $user_detail['userName'] ?></td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td class="text-end"><?php echo $user_detail['userPhonenum'] ?></td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td class="text-end"><?php echo $user_detail['userEmail'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <h5>Order Summary</h5>
                            <span class="border rounded-pill px-3 border-warning bg-ekb text-light"><?php echo $order_detail['orderStatus'] ?></span>
                        </div>
                        <table class="mt-2 w-100">
                            <tr>
                                <th>Order Created</th>
                                <td class="text-end"><?php echo $date_format ?></td>
                            </tr>
                            <tr>
                                <th>Order Time</th>
                                <td class="text-end"><?php echo $arrayDate[1] ?></td>
                            </tr>
                            <tr>
                                <th>Delivery Type</th>
                                <td class="text-end"><?php echo $order_detail['deliveryType'] ?></td>
                            </tr>
                            <?php if ($order_detail['deliveryType'] == 'Postage') {?>
                            <tr>
                                <th>Tracking No</th>
                                <td class="text-end"><?php echo ($order_detail['tracking_number'] == "" ? '-' : $order_detail['tracking_number']) ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table class="w-100">
                            <tr>
                                <th>Total</th>
                                <td class="text-end">RM <?php echo $order_detail['totalPrice'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Delivery Address</h5>
                        <table class="w-100 mt-3">
                            <tr>
                                <th>Address Line </th>
                                <td class="text-end"><?php echo $user_detail['userAddress'] ?></td>
                            </tr>
                            <tr>
                                <th>Poscode </th>
                                <td class="text-end"><?php echo $user_detail['userPoscode'] ?></td>
                            </tr>
                            <tr>
                                <th>City </th>
                                <td class="text-end"><?php echo $user_detail['userCity'] ?></td>
                            </tr>
                            <tr>
                                <th>State </th>
                                <td class="text-end text-capitalize"><?php echo $user_state ?></td>
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

<?php

require ASSET_PATH . 'footer.php';

?>
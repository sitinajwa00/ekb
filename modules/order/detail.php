<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'order.inc.php';

$order = new OrderController();
$response = $order->getOrderDetails($_GET['order_id']);
$detail = $response[0];

$item = new OrderController();
$response = $item->displayAllItemsByOrderID($_GET['order_id']);
$item_list = $response;

// echo json_encode($detail) . '<br>';
// echo json_encode($item_list) ;exit;

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_owner.php';

if (isset($_POST['accept'])) {
    $id = $_GET['order_id'];
    $status = 'Processing';
    $order = new OrderController();
    $order->changeOrderStatus($id, $status);

    echo '<script>
        alert("Order Status: Processing");
        window.location.href = "'.APP_URL.'?module=order&action=detail&order_id='.$_GET['order_id'].'";
    </script>';
} else if (isset($_POST['update_status'])) {
    $id = $_GET['order_id'];
    $status = $_POST['status'];
    $order = new OrderController();
    $order->changeOrderStatus($id, $status);

    echo '<script>
        alert("Order Status: '.$status.'");
        window.location.href = "'.APP_URL.'?module=order&action=detail&order_id='.$_GET['order_id'].'";
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
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=order">Order List</a></li>
                        <li class="breadcrumb-item active text-warning">Detail</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between">
                <div>Order ID #<?php echo $detail['orderID']?></div>
                <div class="border rounded-pill px-3 py-1 bg-warning text-white"><?php echo $detail['orderStatus'] ?></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <div class="mb-2">Order Details</div>
                        <div class="border border-secondary">
                            <table class="table mb-0">
                                <tr class="bg-secondary">
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Price</th>
                                </tr>
                                <?php $total_item = 0; ?>
                                <?php foreach ($item_list as $item) {?>
                                <tr class="border-bottom-0">
                                    <td><?php echo $item['product_name'] ?></td>
                                    <td><?php echo $item['qty'] ?></td>
                                    <td class="text-end">RM <?php echo $item['total_price'] ?></td>
                                </tr>
                                <?php $total_item++; } ?>
                                <tr class="text-end">
                                    <td colspan="2" class="border-end">Total Price:</td>
                                    <td class="fw-bold">RM <?php echo $detail['totalPrice']; ?></td>
                                </tr>
                                <tr class="text-end">
                                    <td colspan="2" class="border-end">Total Item(s):</td>
                                    <td class="fw-bold"><?php echo $total_item; ?></td>
                                </tr>
                                <tr class="text-end">
                                    <td colspan="2" class="border-end">Delivery:</td>
                                    <td class="fw-bold"><?php echo $detail['deliveryType']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-5">
                        <!-- Order Status -->
                        <div class="mb-2">Order Status</div>
                        <div class="border border-secondary p-2">
                            <div class="alert alert-warning" role="alert">
                                Update order status here <i class="fa-regular fa-hand-point-down"></i>
                            </div>
                            <form action="" method="post">
                                <select name="status" id="" class="form-select mb-3">
                                    <option value="Pending" <?php echo ($detail['orderStatus']=='Pending' ? 'selected' : '') ?>>Pending</option>
                                    <option value="Processing" <?php echo ($detail['orderStatus']=='Processing' ? 'selected' : '') ?>>Processing</option>
                                    <option value="To Ship" <?php echo ($detail['orderStatus']=='To Ship' ? 'selected' : '') ?>>To Ship</option>
                                    <option value="Out For Delivery" <?php echo ($detail['orderStatus']=='Out For Delivery' ? 'selected' : '') ?>>Out For Delivery</option>
                                    <option value="Complete" <?php echo ($detail['orderStatus']=='Complete' ? 'selected' : '') ?>>Complete</option>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-secondary update_btn" <?php echo ($detail['orderStatus']=='Complete' ? 'disabled' : '') ?>>Update</button>
                            </form>
                        </div>

                        <!-- Shipping Details -->
                        <div class="mt-4 mb-2">Shipping Details</div>
                        <div class="border border-secondary bg-light p-2">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Name</td>
                                    <td class="fw-bold"><?php echo $detail['userName'] ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td class="fw-bold"><?php echo $detail['userPhonenum'] ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="fw-bold"><?php echo $detail['shippingAddress'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="fw-bold"><?php echo $detail['userEmail'] ?></td>
                                </tr>
                            </table>
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
    // $(document).on('change', '[name="status"]', function() {
    //     $('.update_btn').click();
    // });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
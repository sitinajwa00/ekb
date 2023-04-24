<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'order.inc.php';

$order = new OrderController();
$response = $order->getOrderDetails($_GET['order_id']);
$detail = $response[0];

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
        <div class="d-flex justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form action="" method="post">
                            <table class="table">
                                <tr>
                                    <td>Customer</td>
                                    <td class="fw-bold"><?php echo $detail['userName'] ?></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td class="fw-bold"><?php echo $detail['date'] ?></td>
                                </tr>
                                <tr>
                                    <td>Product</td>
                                    <td class="fw-bold"><?php echo substr($detail['orderItem'], 0, -2) ?></td>
                                </tr>
                                <tr>
                                    <td>Total Price</td>
                                    <td class="fw-bold"><?php echo 'RM ' . $detail['totalPrice'] ?></td>
                                </tr>
                                <tr>
                                    <td>Delivery</td>
                                    <td class="fw-bold"><?php echo ($detail['paymentMethod']=='cod' ? 'Cash On Delivery (COD)' : 'Postage') ?></td>
                                </tr>
                                <?php  
                                if ($detail['orderStatus'] != 'Pending') {
                                    echo '<tr>
                                            <td>Order Status</td>
                                            <td class="fw-bold">
                                                <select class="form-select" name="status">
                                                    <option value="Processing"'.($detail['orderStatus']=='Processing' ? 'selected' : '').'>Processing</option>
                                                    <option value="To Ship"'.($detail['orderStatus']=='To Ship' ? 'selected' : '').'>To Ship</option>
                                                    <option value="Out For Delivery"'.($detail['orderStatus']=='Out For Delivery' ? 'selected' : '').'>Out For Delivery</option>
                                                    <option value="Complete"'.($detail['orderStatus']=='Complete' ? 'selected' : '').'>Complete</option>
                                                </select>
                                            </td>
                                        </tr>';
                                }
                                ?>
                                
                            </table>
                            <?php 
                            if ($detail['orderStatus']=='Pending')
                                echo '<button type="submit" name="accept" class="btn btn-primary">Accept</button>';
                            else 
                                echo '<button type="submit" name="update_status" class="btn btn-primary update_btn" hidden>Update</button>';
                            ?>
                        </form>
                    </div>
                </div>
                <div class="text-end mt-2">
                    <button class="btn btn-primary" onclick="window.location.href='<?php echo APP_URL ?>?module=order'">Order List&emsp;<i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
    $(document).on('change', '[name="status"]', function() {
        $('.update_btn').click();
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
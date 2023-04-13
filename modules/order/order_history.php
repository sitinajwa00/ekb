<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'order.inc.php';

$order = new OrderController();
$order_result = $order->displayAllOrders($_SESSION['user']['id']);

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
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                </li>
                <!-- Tab: Pending -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Pending</button>
                </li>
                <!-- Tab: Processing -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing" type="button" role="tab" aria-controls="profile" aria-selected="false">Processing</button>
                </li>
                <!-- Tab: Shipping -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="ship-tab" data-bs-toggle="tab" data-bs-target="#ship" type="button" role="tab" aria-controls="ship" aria-selected="false">To Ship</button>
                </li>
                <!-- Tab: Delivery -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">Out for Delivery</button>
                </li>
                <!-- Tab: Complete -->
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="false">Complete</button>
                </li>
            </ul>
            <!-- Tab Content -->
            <div class="tab-content" id="myTabContent">
                <!-- Tab Content: All -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="bg-white py-5 container">
                        <?php 
                        foreach ($order_result as $val) {
                            echo '
                            <div class="bg-light mb-2">
                                <table class="table align-middle">
                                    <tbody>
                                        <tr>
                                            <td>'.$val['orderStatus'].'</td>
                                            <td class="text-end">View Details</td>
                                        </tr>
                                        <tr>
                                            <td>'. substr($val['orderItem'], 0, -2) .'</td>
                                            <td class="text-end">Total Order: RM'.$val['totalPrice'].'</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">
                                                '.($val['paymentMethod']=='cod' ? 'Cash On Delivery' : 'Postage').'
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            ';
                        }
                        ?>
                        <!-- <div class="bg-light mb-2">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Out for Delivery</td>
                                        <td class="text-end">View Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1">
                                            <img src="img/default_image.jpg" alt="" class="w-100">
                                        </td>
                                        <td>
                                            Original<br>
                                            x3
                                        </td>
                                        <td class="text-end">Rm9.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            Total Order: RM27.00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                        <!-- <div class="bg-light mb-2">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Out for Delivery</td>
                                        <td class="text-end">View Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1">
                                            <img src="img/default_image.jpg" alt="" class="w-100">
                                        </td>
                                        <td>
                                            Original<br>
                                            x3
                                        </td>
                                        <td class="text-end">Rm9.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            Total Order: RM27.00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-light mb-2">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Complete</td>
                                        <td class="text-end">View Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1">
                                            <img src="img/default_image.jpg" alt="" class="w-100">
                                        </td>
                                        <td>
                                            Salted Egg<br>
                                            x2
                                        </td>
                                        <td class="text-end">Rm10.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            Total Order: RM20.00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-light mb-2">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Complete</td>
                                        <td class="text-end">View Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1">
                                            <img src="img/default_image.jpg" alt="" class="w-100">
                                        </td>
                                        <td>
                                            Original<br>
                                            x3
                                        </td>
                                        <td class="text-end">Rm9.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            Total Order: RM27.00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                </div>
                <!-- Tab Content: Pending -->
                <div class="tab-pane fade show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="bg-white py-5 container">
                        <div class="bg-light mb-2">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Pending</td>
                                        <td class="text-end">View Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1">
                                            <img src="img/default_image.jpg" alt="" class="w-100">
                                        </td>
                                        <td>
                                            Original<br>
                                            x3
                                        </td>
                                        <td class="text-end">Rm9.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            Total Order: RM27.00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-light mb-2">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Pending</td>
                                        <td class="text-end">View Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col-1">
                                            <img src="img/default_image.jpg" alt="" class="w-100">
                                        </td>
                                        <td>
                                            Salted Egg<br>
                                            x2
                                        </td>
                                        <td class="text-end">Rm10.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            Total Order: RM20.00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Tab Content: Processing -->
                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="pprocessing-tab">
                    <div class="bg-white py-5 container">
                        <div class="text-center">
                            <h5>No Orders Available</h5>
                        </div>
                    </div>
                </div>
                <!-- Tab Content: Shipping -->
                <div class="tab-pane fade" id="ship" role="tabpanel" aria-labelledby="ship-tab">To Ship</div>
                <!-- Tab Content: Delivery -->
                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">Out for Delivery</div>
                <!-- Tab Content: Complete -->
                <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">Complete</div>
            </div>
        </div>
    </main>
    <!--Main layout-->

<?php 
require ASSET_PATH . 'footer.php';
?>
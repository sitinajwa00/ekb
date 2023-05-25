<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require INCL_PATH . 'product.inc.php';
require INCL_PATH . 'cart.inc.php';
require INCL_PATH . 'report.inc.php';
require INCL_PATH . 'order.inc.php';
require INCL_PATH . 'dashboard.inc.php';

// $user = new UserController();
// $response = $user->displayAllUsers();

// echo json_encode($response);

// echo '<br><br>';

// $cust = new UserController();
// $response2 = $cust->displayAllCustomers('2');

// echo json_encode($response2);

// echo '<br><br>';

// $prod = new ProductController();
// $prod_result = $prod->displayAllProducts();

// echo json_encode($prod_result);

// echo '<br><br>';

// $user_view = new UserView();
// $user_view_result = $user_view->viewAllUsers();

// echo json_encode($user_view_result);
// echo '<br>' . $user_view_result['result'][1]['userEmail'];

// echo '<br><br>';

// $message = new UserView();
// $messageResult = $message->sendErrorMessage();

// echo $messageResult;

// echo '<br><br>';

// $product = new ProductPage();
// $product_result = $product->displayProductPage();

// echo json_encode($product_result);

// $cart = new CartController();
// $result = $cart->displayAllCartsByUser($_SESSION['user']['id']);

// $item_cod = '';
// $item_pos = '';

// foreach ($result as $val) {
//     if ($val['delivery_type'] == 'cod') 
//         $item_cod .= $val['product_name'] . '(' . $val['order_qty'] . '), ' ;
//     else if ($val['delivery_type'] == 'pos')
//         $item_pos .= $val['product_name'] . '(' . $val['order_qty'] . '), ' ;
// }


// echo substr($item_cod, 0, -1);

// $report = new ReportController();
// $result = $report->displayTotalSalesByMonth('COD');

// echo json_encode($result);

// $report = new ReportController();
// $result = $report->displayTotalSalesDailyByMonth('COD', 4, 2023);

// echo json_encode($result);

// $updateQty = new ProductController();
// $updateQty->updateQty('23', 3);

// echo 'check db';

// $order_id = new OrderController();
// $result = $order_id->displayOrderID('11');

// echo json_encode($result[0]['orderID']);

$dashboard = new DashboardController();
$result = $dashboard->displayTotalSales();
echo json_encode($result);

?>
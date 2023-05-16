<?php

require_once(APP_PATH . 'vendor/autoload.php');
require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'payment.inc.php';
require INCL_PATH . 'cart.inc.php';
require INCL_PATH . 'order.inc.php';
require INCL_PATH . 'product.inc.php';

\Stripe\Stripe::setApiKey('sk_test_51MjBwfA0sa0MTkHNCLDSFy5yO2EktVUIPampYq8KL3WGdvd2mIrSe9ERVobbz7eLcdJDOeVfs5ZDPcSw730J41oR00Mtu5W9Bw');

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$full_name = $POST['full_name'];
$email = $POST['email'];
$phonenum = $POST['phonenum'];
$amount = ($_SESSION['payment']['amount'] * 100);
$token = $POST['stripeToken'];

// Create Customer in Stripe
$customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token
));

// Charge Customer
$charge = \Stripe\Charge::create(array(
    "amount" => $amount,
    "currency" => 'MYR',
    "description" => "EKB Payment",
    "customer" => $customer->id
));

// Detail
$custID = $_SESSION['user']['id'];
$chargeID = $charge->id;
$amount = $charge->amount / 100;
$amount_cod = (isset($_SESSION['payment']['cod']) ? $_SESSION['payment']['cod'] : 0);
$address = $_SESSION['user']['address'];
$status = $charge->status;

// Cart Item
$cart = new CartController();
$result = $cart->displayAllCartsByUser($custID);

$item_cod = '';
$item_pos = '';

foreach ($result as $val) {
    if ($val['delivery_type'] == 'cod') 
        $item_cod .= $val['product_name'] . '(' . $val['order_qty'] . '), ' ;
    else if ($val['delivery_type'] == 'pos')
        $item_pos .= $val['product_name'] . '(' . $val['order_qty'] . '), ' ;
}

// Payment Database
$payment = new PaymentController();
$payment->getPaymentDetails($custID, $chargeID, $amount, $status);

// Order Database
$order_pos = new OrderController();
$order_pos->sendOrderDetailsPos($custID, $chargeID, $item_pos, $amount, $address, $status);

if ($_SESSION['cart']['cod'] > 0) {
    $order_cod = new OrderController();
    $order_cod->sendOrderDetailsCod($custID, $item_cod, $amount_cod, $address, $status);
}

// Update Product Database
foreach ($result as $val) {
    $updateQty = new ProductController();
    $updateQty->updateQty($val['productID'], (int)$val['order_qty']);
}

// Update Cart Database
$checkoutStatus = new CartController();
$checkoutStatus->editCheckoutStatus($custID, '1');

// Remove Cart from database
$removeCart = new CartController();
$removeCart->removeCart($custID);

echo '<script>
    alert("Payment Successful");
    window.location.href = "'.APP_URL.'?module=payment&action=complete";
</script>';

// header('Location: ' . APP_URL . '?module=payment&action=complete');
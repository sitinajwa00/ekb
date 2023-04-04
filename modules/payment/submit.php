<?php

require_once(APP_PATH . 'vendor/autoload.php');
require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'payment.inc.php';
require INCL_PATH . 'cart.inc.php';

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

$custID = $_SESSION['user']['id'];
$chargeID = $charge->id;
$amount = $charge->amount / 100;
$status = $charge->status;

$payment = new PaymentController();
$payment->getPaymentDetails($custID, $chargeID, $amount, $status);

$cart = new CartController;
$cart->editCheckoutStatus($custID, '1');

echo '<script>
    alert("Payment Successful");
    window.location.href = "'.APP_URL.'?module=payment&action=complete";
</script>';

// header('Location: ' . APP_URL . '?module=payment&action=complete');
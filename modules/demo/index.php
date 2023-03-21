<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';
require INCL_PATH . 'product.inc.php';

$user = new UserController();
$response = $user->displayAllUsers();

echo json_encode($response);

echo '<br><br>';

$cust = new UserController();
$response2 = $cust->displayAllCustomers('2');

echo json_encode($response2);

echo '<br><br>';

$prod = new ProductController();
$prod_result = $prod->displayAllProducts();

echo json_encode($prod_result);

echo '<br><br>';

$user_view = new UserView();
$user_view_result = $user_view->viewAllUsers();

echo json_encode($user_view_result);

echo '<br><br>';

$message = new UserView();
$messageResult = $message->sendErrorMessage();

echo $messageResult;

?>
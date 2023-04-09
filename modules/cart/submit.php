<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'cart.inc.php';
require INCL_PATH . 'order.inc.php';

if (isset($_GET['cart_id'])) {
    $cart = new CartController();
    $cart->removeCart($_GET['cart_id']);

    echo '<script>
        window.location.href = "'.APP_URL.'?module=cart";
    </script>';
} else if (isset($_GET['response'])) {
    // get Cart detail
    $cart = new CartController();
    $result = $cart->displayAllCartsByUser($_SESSION['user']['id']);

    $item_cod = '';

    foreach ($result as $val) {
        if ($val['delivery_type'] == 'cod') 
            $item_cod .= $val['product_name'] . '(' . $val['order_qty'] . '), ' ;
    }

    // Order Database
    $order_cod = new OrderController();
    $order_cod->sendOrderDetailsCod($custID, $item_cod, $amount, $_SESSION['user']['address'], $status);

    echo '<script>
        window.location.href = "'.APP_URL.'?module=order&action=order_history";
    </script>';
}
?>
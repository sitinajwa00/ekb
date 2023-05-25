<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'cart.inc.php';
require INCL_PATH . 'order.inc.php';
require INCL_PATH . 'product.inc.php';

if (isset($_GET['cart_id'])) {
    $cart = new CartController();
    $cart->removeCartById($_GET['cart_id']);

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
    $custID = $_SESSION['user']['id'];
    $status = '';
    $order_cod = new OrderController();
    $order_cod->sendOrderDetailsCod($custID, $item_cod, $_SESSION['payment']['cod'], $_SESSION['user']['address'], $status);

    // Get Order ID and insert into DB order_items
    $order_id = new OrderController();
    $order_id = $order_id->displayOrderID($custID); 
    $order_id = $order_id[0]['orderID'];

    foreach ($result as $val) {
        $order_items = new OrderController();
        $order_items->sendOrderItemsDetail($order_id, $val['product_name'], $val['order_qty'], $val['total_price'], 'COD');
    }

    // Update Product Database
    foreach ($result as $val) {
        $updateQty = new ProductController();
        $updateQty->updateQty($val['productID'], (int)$val['order_qty']);
    }

    // Update Cart Database
    $checkoutStatus = new CartController;
    $checkoutStatus->editCheckoutStatus($custID, '1');

    // Remove Cart from database
    $removeCart = new CartController;
    $removeCart->removeCart($custID);

    echo '<script>
        alert("Redirect to Order History");
        window.location.href = "'.APP_URL.'?module=order&action=order_history";
    </script>';
}
?>
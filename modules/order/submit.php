<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'cart.inc.php';

if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user']['id'];
    $product_id = $_GET['product_id'];
    $product_name = $_POST['product_name'];
    $delivery_type = $_POST['delivery_type'];
    $unit_price = $_POST['unit_price'];
    $qty = $_POST['order_qty'];
    $total_price = number_format($unit_price * $qty, 2);

    // Check Item In Cart
    $item = new CartController();
    $result = $item->checkItemInCart($user_id, $product_id);
    echo json_encode($result);

    if (count($result) > 0 && $result[0]['delivery_type']==$delivery_type) {
        $cart_id = $result[0]['cartID'];
        $unit_price = (float)$result[0]['unit_price'];
        $item_qty = (int)$result[0]['order_qty'] + $qty;
        $total_price = $unit_price * $item_qty;
        $cart = new CartController();
        $cart->editQty($cart_id, $item_qty, $total_price);
    } else {
        $cart = new CartController();
        $cart->createCart($user_id, $product_id, $product_name, $delivery_type, $unit_price, $qty, $total_price);
    }

    // echo $product_name;
    // $cart = new CartController();
    // $cart->createCart($user_id, $product_id, $product_name, $delivery_type, $unit_price, $qty, $total_price);

    ?>

    <script>
        var text = 'Successfully Add To Cart!\nRedirect to the cart page?';

        if (confirm(text) == true) {
            window.location.href = "<?php echo APP_URL ?>?module=order&action=cart";
        } else {
            window.history.back();
        }
    </script>

    <?php
    
}

?>
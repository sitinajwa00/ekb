<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'cart.inc.php';

if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user']['id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $delivery_type = $_POST['delivery_type'];
    $unit_price = $_POST['unit_price'];
    $qty = $_POST['order_qty'];
    $total_price = number_format($unit_price * $qty, 2);

    // Check Item In Cart
    $item = new CartController();
    $result = $item->checkItemInCart($user_id, $product_id);
    // echo json_encode($result);

    if (count($result) > 0) {
        foreach ($result as $res) {
            if (isset($res['delivery_type']) && $res['delivery_type']==$delivery_type) {
                $cart_id = $res['cartID'];
                $unit_price = (float)$res['unit_price'];
                $item_qty = (int)$res['order_qty'] + $qty;
                $total_price = $unit_price * $item_qty;
                $cart = new CartController();
                $cart->editQty($cart_id, $item_qty, $total_price);
            } else {
                $cart = new CartController();
                $cart->createCart($user_id, $product_id, $product_name, $delivery_type, $unit_price, $qty, $total_price);
            }
        }
    } else {
        $cart = new CartController();
        $cart->createCart($user_id, $product_id, $product_name, $delivery_type, $unit_price, $qty, $total_price);
    }

    // echo $product_name;
    // $cart = new CartController();
    // $cart->createCart($user_id, $product_id, $product_name, $delivery_type, $unit_price, $qty, $total_price);

    ?>

    <script>
        // var text = 'Successfully Add To Cart!\nRedirect to the cart page?';

        // if (confirm(text) == true) {
        //     window.location.href = "<?php echo APP_URL ?>?module=cart";
        // } else {
        //     window.history.back();
        // }
        alert('Successfully Add To Cart');
        window.history.back();
    </script>

    <?php
    
} else if (isset($_GET['cart_id'])) {
    $cart = new CartController();
    $cart->removeCart($_GET['cart_id']);

    echo '<script>
        window.location.href = "'.APP_URL.'?module=order&action=cart";
    </script>';
}

?>
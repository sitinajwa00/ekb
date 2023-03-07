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

    // echo $product_name;
    $cart = new CartController();
    $cart->createCart($user_id, $product_id, $product_name, $delivery_type, $unit_price, $qty, $total_price);

    ?>

    <script>
        var text = 'Successfully Add To Cart!\nRedirect to the cart page?';

        if (confirm(text) == true) {
            // $(location).attr('href', '<?php echo APP_URL ?>?module=cart');
            window.location.href = "<?php echo APP_URL ?>?module=cart";
        } else {
            window.history.back();
        }
    </script>

    <?php
    
}

?>
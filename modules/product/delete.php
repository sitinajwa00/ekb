<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

if (isset($_GET['product_id'])) {
    $product = new DeleteProductPage();
    echo $product->confirmDeleteProduct($_GET['product_id']);
}


?>
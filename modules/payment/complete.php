<?php 

require ASSET_PATH . 'header.php';

?>

<div class="container mt-4">
    <h2>Thank you for purchasing our products</h2>
    <hr>
    <p>Your total amount: RM <?php echo $_SESSION['payment']['amount'] ?></p>
    <span class="btn btn-primary"><a href="<?php echo APP_URL ?>?module=order&action=order_history" class="text-light">Complete order</a></span>
</div>
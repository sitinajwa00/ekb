<?php 

$demo = new CartController();
$res = $demo->displayAllCartsByUser($_SESSION['user']['id']);
$clist = $res;
// $cartCount = count($clist);

?>
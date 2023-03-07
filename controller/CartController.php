<?php

class CartController extends Cart {
    public function displayAllCartsByUser($userID) {
        $results = $this->getAllCartsByUser($userID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function createCart($userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price) {
        $this->insertCart($userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price);
    }
}

?>
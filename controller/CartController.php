<?php

class CartController extends Cart {
    public function displayAllCartsByUser($userID) {
        $results = $this->getAllCartsByUser($userID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function displayCart($cartID) {
        $results = $this->getCart($cartID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function checkItemInCart($userID, $productID) {
        $results = $this->getItemInCart($userID, $productID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function createCart($userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price) {
        $this->insertCart($userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price);
    }

    public function editQty($cartID, $qty, $total_price) {
        $this->updateQty($cartID, $qty, $total_price);
    }

    public function removeCart($cartID) {
        $this->deleteCart($cartID);
    }
}

?>
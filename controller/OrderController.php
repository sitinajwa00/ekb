<?php

class OrderController extends Order {
    public function sendOrderDetailsPos($custID, $chargeID, $item, $amount, $shipAddress, $status) {
        $this->makeOrderPos($custID, $chargeID, $item, $amount, $shipAddress, $status);
    }

    public function sendOrderDetailsCod($custID, $item, $amount, $shipAddress, $status) {
        $this->makeOrderCod($custID, $item, $amount, $shipAddress, $status);
    }

    public function displayOrderID($custID) {
        $results = $this->getOrderID($custID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function sendOrderItemsDetail($orderID, $productName, $qty, $totalPrice, $deliveryType) {
        $this->sendOrderItems($orderID, $productName, $qty, $totalPrice, $deliveryType);
    }

    public function displayAllOrders($custID) {
        $results = $this->getAllOrdersByUser($custID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function displayAllItemsByOrderID($orderID) {
        $results = $this->getAllItemsByOrderID($orderID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function displayOrderList() {
        $results = $this->getAllOrders();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function getOrderDetails($orderID) {
        $results = $this->getOrder($orderID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function changeOrderStatus($id, $status) {
        $this->updateOrderStatus($id, $status);
    }
}

?>
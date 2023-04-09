<?php

class OrderController extends Order {
    public function sendOrderDetailsPos($custID, $chargeID, $item, $amount, $shipAddress, $status) {
        $this->makeOrderPos($custID, $chargeID, $item, $amount, $shipAddress, $status);
    }

    public function sendOrderDetailsCod($custID, $item, $amount, $shipAddress, $status) {
        $this->makeOrderCod($custID, $item, $amount, $shipAddress, $status);
    }
}

?>
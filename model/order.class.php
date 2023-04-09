<?php 

class Order extends Db {
    protected function makeOrderPos($custID, $chargeID, $item, $amount, $shipAddress, $status) {
        $sql = "INSERT INTO orders(custID, chargeID, paymentMethod, orderItem, totalPricePos, shippingAddress, orderStatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, $chargeID, 'card', $item, $amount, $shipAddress, 'Pending']);
    }

    protected function makeOrderCod($custID, $item, $amount, $shipAddress, $status) {
        $sql = "INSERT INTO orders(custID, paymentMethod, orderItem, totalPriceCod, shippingAddress, orderStatus) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, 'cod', $item, $amount, $shipAddress, 'Pending']);
    }
}

?>
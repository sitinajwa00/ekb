<?php 

class Order extends Db {
    protected function makeOrderPos($custID, $chargeID, $item, $amount, $shipAddress, $status) {
        $sql = "INSERT INTO orders(custID, chargeID, deliveryType, orderItem, totalPrice, shippingAddress, orderStatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, $chargeID, 'Postage', $item, $amount, $shipAddress, 'Pending']);
    }

    protected function makeOrderCod($custID, $item, $amount, $shipAddress, $status) {
        $sql = "INSERT INTO orders(custID, deliveryType, orderItem, totalPrice, shippingAddress, orderStatus) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, 'COD', $item, $amount, $shipAddress, 'Pending']);
    }

    protected function getAllOrdersByUser($custID) {
        $sql = "SELECT * FROM orders WHERE custID=$custID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getAllOrders() {
        $sql = "SELECT * FROM orders, users WHERE orders.custID=users.userID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getOrder($id) {
        $sql = "SELECT * FROM orders, users WHERE orderID = ? AND orders.custID=users.userID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function updateOrderStatus($id, $status) {
        $sql = "UPDATE orders SET 
            orderStatus=:orderStatus WHERE orderID=:orderID";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':orderID', $id);
        $stmt->bindParam(':orderStatus', $status);

        $stmt->execute();
    }
}

?>
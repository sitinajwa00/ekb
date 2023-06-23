<?php 

class Order extends Db {
    protected function makeOrderPos($custID, $chargeID, $item, $amount, $shipAddress, $status) {
        $sql = "INSERT INTO orders(custID, chargeID, deliveryType, orderItem, totalPrice, shippingAddress, orderStatus, tracking_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, $chargeID, 'Postage', $item, $amount, $shipAddress, 'Pending', '']);
    }

    protected function makeOrderCod($custID, $item, $amount, $shipAddress, $status) {
        $sql = "INSERT INTO orders(custID, chargeID, deliveryType, orderItem, totalPrice, shippingAddress, orderStatus, tracking_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$custID, '', 'COD', $item, $amount, $shipAddress, 'Pending', '']);
    }

    protected function getOrderID($custID) {
        $sql = "SELECT orderID FROM orders WHERE custID=$custID ORDER BY orderID DESC LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function sendOrderItems($orderID, $productName, $qty, $totalPrice, $type) {
        $sql = "INSERT INTO order_items(order_id, product_name, qty, total_price, delivery_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$orderID, $productName, $qty, $totalPrice, $type]);
    }

    protected function getAllOrdersByUser($custID) {
        $sql = "SELECT * FROM orders WHERE custID=$custID ORDER BY date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getAllItemsByOrderID($orderID) {
        $sql = "SELECT * FROM order_items WHERE order_id=$orderID";
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

    protected function saveTrackingNumber($id, $num) {
        $sql = "UPDATE orders SET tracking_number=:tracknum WHERE orderID=:orderID";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':orderID', $id);
        $stmt->bindParam(':tracknum', $num);
        
        $stmt->execute();
    }
}

?>
<?php 

class Cart extends Db {
    protected function getAllCartsByUser($userID) {
        $sql = "SELECT * FROM cart WHERE userID = $userID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function insertCart($userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price) {
        $sql = "INSERT INTO cart(userID, productID, product_name, delivery_type, unit_price, order_qty, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price]);
    }
}

?>
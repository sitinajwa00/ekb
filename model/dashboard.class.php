<?php 

class Dashboard extends Db {
    protected function getTotalSales() {
        $sql = "SELECT SUM(totalPrice) AS sales FROM orders";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getTotalProductSold() {
        $sql = "SELECT SUM(qty) AS total_product_sold FROM order_items";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getTotalCustomer() {
        $sql = "SELECT COUNT(userID) AS total_customer FROM users WHERE userType = 2";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getTotalPendingOrder() {
        $sql = "SELECT COUNT(orderID) AS total_pending FROM orders WHERE orderStatus = 'Pending'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }
}

?>
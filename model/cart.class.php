<?php 

class Cart extends Db {
    protected function getAllCartsByUser($userID) {
        $sql = "SELECT * FROM carts,products WHERE userID = $userID AND carts.productID=products.productID AND checkout_status = '0' ORDER BY delivery_type";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getCart($cartID) {
        $sql = "SELECT * FROM carts WHERE cartID=$cartID";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getItemInCart($userID, $productID) {
        $sql = "SELECT * FROM carts WHERE userID=$userID AND productID=$productID AND checkout_status = '0'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function insertCart($userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price) {
        $sql = "INSERT INTO carts(userID, productID, product_name, delivery_type, unit_price, order_qty, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID, $productID, $product_name, $delivery_type, $unit_price, $order_qty, $total_price]);
    }

    protected function updateQty($cartID, $qty, $total_price) {
        $sql = "UPDATE carts SET order_qty=:order_qty, total_price=:total_price WHERE cartID=:cartID";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':cartID', $cartID);
        $stmt->bindParam(':order_qty', $qty);
        $stmt->bindParam(':total_price', $total_price);

        $stmt->execute();
    }

    protected function updateCheckoutStatus($userID, $status) {
        $sql = "UPDATE carts SET checkout_status=:checkout_status WHERE userID=:userID AND checkout_status = '0'";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':checkout_status', $status);

        $stmt->execute();
    }

    protected function deleteCart($cartID) {
        $sql = "DELETE from carts WHERE cartID='$cartID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }
}

?>
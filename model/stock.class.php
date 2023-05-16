<?php 

class Stock extends Db {
    protected function stockDecrement($product_qty, $product_id) {
        $sql = "INSERT INTO stocks (stockDecrement) VALUES (?) WHERE product_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product_qty, $product_id]);
    }
}

?>
<?php

class StockController extends Stock {
    public function sendStockDecrement($product_qty, $product_id) {
        $this->stockDecrement($product_qty, $product_id);
    }
}

?>
<?php

class DeleteProductPage extends ProductController {
    public function confirmDeleteProduct($productID) {
        $this->removeProduct($productID);
    }
}

?>
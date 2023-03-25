<?php

class ProductController extends Product {
    public function displayAllProducts() {
        $results = $this->getAllProducts();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function getProductDetails($productID) {
        $results = $this->getProduct($productID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function sendProductDetails($name, $is_cod, $is_pos, $price_cod, $price_dvry, $weight, $desc, $image) {
        $this->setProductDetails($name, $is_cod, $is_pos, $price_cod, $price_dvry, $weight, $desc, $image);
    }

    public function updateProductDetails($id, $name, $is_cod, $is_pos, $price_cod, $price_delivery, $weight, $desc, $image) {
        $this->updateProduct($id, $name, $is_cod, $is_pos, $price_cod, $price_delivery, $weight, $desc, $image);
    }

    public function removeProduct($productID) {
        $this->deleteProduct($productID);
    }
}

?>
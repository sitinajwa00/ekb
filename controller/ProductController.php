<?php

class ProductController extends Product {
    public function displayAllProducts() {
        $results = $this->getAllProducts();
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function displayProduct($productID) {
        $results = $this->getProduct($productID);
        $encode = json_encode($results);
        $response = json_decode($encode, true);

        return $response;
    }

    public function createProduct($name, $is_cod, $is_delivery, $price_cod, $price_dvry, $weight, $desc, $image) {
        $this->insertProduct($name, $is_cod, $is_delivery, $price_cod, $price_dvry, $weight, $desc, $image);
    }

    public function editProduct($id, $name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $image) {
        $this->updateProduct($id, $name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $image);
    }

    public function removeProduct($productID) {
        $this->deleteProduct($productID);
    }
}

?>
<?php 

class AddProductPage extends ProductController {
    public function setProductDetails($name, $is_cod, $is_pos, $price_cod, $price_dvry, $weight, $desc, $image) {
        $this->createProduct($name, $is_cod, $is_pos, $price_cod, $price_dvry, $weight, $desc, $image);
    }
}

?>
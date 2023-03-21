<?php

class ProductPage extends ProductController {
    public function displayProductPage() {
        $results = $this->displayAllProducts();

        $data['message'] = 'Successful';
        $data['status'] = true;
        $data['result'] = $results;

        return $data;
    }
}

?>
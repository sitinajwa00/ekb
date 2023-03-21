<?php 

class EditProductPage extends ProductController {
    public function displayEditProductPage($productID) {
        $results = $this->displayProduct($productID);

        $data['message'] = 'Successful';
        $data['status'] = true;
        $data['result'] = $results;

        return $data;
    }

    public function editProduct($id, $name, $is_cod, $is_pos, $price_cod, $price_delivery, $weight, $desc, $image) {
        $this->sendProductDetails($id, $name, $is_cod, $is_pos, $price_cod, $price_delivery, $weight, $desc, $image);
    }
}

?>
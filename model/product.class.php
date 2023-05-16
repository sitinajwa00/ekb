<?php 

class Product extends Db {
    protected function getAllProducts() {
        $sql = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getProduct($id) {
        $sql = "SELECT * FROM products WHERE productID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();
        return $results;
    }

    protected function setProductDetails($name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $image, $qty) {
        $sql = "INSERT INTO products (productName, is_cod, is_pos, productPriceCOD, productPricePos, productWeight, productDesc, productImage, productQty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $image, $qty]);
    }

    protected function updateProduct($id, $name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $image) {
        $sql = "UPDATE products SET 
            productName=:productName, 
            is_cod=:is_cod, 
            is_pos=:is_pos, 
            productPriceCOD=:productPriceCOD, 
            productPricePos=:productPricePos,
            productWeight=:productWeight,
            productDesc=:productDesc,
            productImage=:productImage WHERE 
            productID=:productID";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':productID', $id);
        $stmt->bindParam(':productName', $name);
        $stmt->bindParam(':is_cod', $is_cod);
        $stmt->bindParam(':is_pos', $is_pos);
        $stmt->bindParam(':productPriceCOD', $price_cod);
        $stmt->bindParam(':productPricePos', $price_pos);
        $stmt->bindParam(':productWeight', $weight);
        $stmt->bindParam(':productDesc', $desc);
        $stmt->bindParam(':productImage', $image);

        $stmt->execute();
    }

    protected function deleteProduct($productID) {
        $sql = "DELETE from products WHERE productID='$productID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function addProductQty($product_id, $qty) {
        $sql = "UPDATE products SET productQty=productQty + ? WHERE productID=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$qty, $product_id]);
    }

    protected function updateProductQty($product_id, $qty) {
        $sql = "UPDATE products SET productQty=productQty - ? WHERE productID=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$qty, $product_id]);
    }
}

?>
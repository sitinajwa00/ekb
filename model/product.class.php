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

    protected function insertProduct($name, $is_cod, $is_delivery, $price_cod, $price_dvry, $weight, $desc, $image) {
        $sql = "INSERT INTO products (productName, is_cod, is_delivery, productPriceCOD, productPriceDvry, productWeight, productDesc, productImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $is_cod, $is_delivery, $price_cod, $price_dvry, $weight, $desc, $image]);
    }

    protected function updateProduct($id, $name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $image) {
        $sql = "UPDATE products SET 
            productName=:productName, 
            is_cod=:is_cod, 
            is_delivery=:is_delivery, 
            productPriceCOD=:productPriceCOD, 
            productPriceDvry=:productPriceDvry,
            productWeight=:productWeight,
            productDesc=:productDesc,
            productImage=:productImage WHERE 
            productID=:productID";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(':productID', $id);
        $stmt->bindParam(':productName', $name);
        $stmt->bindParam(':is_cod', $is_cod);
        $stmt->bindParam(':is_delivery', $is_delivery);
        $stmt->bindParam(':productPriceCOD', $price_cod);
        $stmt->bindParam(':productPriceDvry', $price_delivery);
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
}

?>
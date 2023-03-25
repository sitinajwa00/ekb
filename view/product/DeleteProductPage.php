<?php

class DeleteProductPage extends ProductController {
    public function confirmDeleteProduct($productID) {
        $this->removeProduct($productID);

        echo '<script>
            alert("Successfully Delete Product");
            window.location.href = "'.APP_URL.'?module=product";
        </script>';
    }
}

?>
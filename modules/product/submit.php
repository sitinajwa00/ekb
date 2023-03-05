<?php 

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $desc = $_POST['description'];
    $weight = (isset($_POST['weight']) ? $_POST['weight'] : 'no');
    $is_cod = (isset($_POST['is_cod']) ? $_POST['is_cod'] : '0');
    $is_delivery = (isset($_POST['is_delivery']) ? $_POST['is_delivery'] : '0');
    $price_cod = $_POST['codPrice'];
    $price_delivery = $_POST['dvryPrice'];

    if ($_FILES['image']['error'] === 4) {
        $newImageName = '';
    } else {
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $tempName = $_FILES['image']['tmp_name'];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo '<script>alert("Image Size is Too Large");</script>';
        } else {
            $newImageName = 'ekb_'.uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tempName, IMG_PATH . $newImageName);
            
            $product = new ProductController();
            $product->createProduct($name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $newImageName);

            echo '<script>
                alert("Successfully Add New Product");
                window.location.href = "'.APP_URL.'?module=product";
            </script>';


        }
    }

        
} else if (isset($_POST['save'])) {
    $id = $_GET['product_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $weight = (isset($_POST['weight']) ? $_POST['weight'] : 'no');
    $is_cod = (isset($_POST['is_cod']) ? $_POST['is_cod'] : '0');
    $is_delivery = (isset($_POST['is_delivery']) ? $_POST['is_delivery'] : '0');
    $price_cod = $_POST['codPrice'];
    $price_delivery = $_POST['dvryPrice'];
    $old_image = (isset($_POST['old_image']) ? $_POST['old_image'] : '');

    if ($_FILES['image']['error'] === 4) {
        $newImageName = $old_image;

        $product = new ProductController();
        $product->editProduct($id, $name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $old_image);

        echo '<script>
            alert("Successfully Update Product");
            window.location.href = "'.APP_URL.'?module=product&action=detail&product_id='.$id.'";
        </script>';
    } else {
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $tempName = $_FILES['image']['tmp_name'];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo '<script>alert("Image Size is Too Large");</script>';
        } else {
            $newImageName = 'ekb_'.uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tempName, IMG_PATH . $newImageName);
            
            $product = new ProductController();
            $product->editProduct($id, $name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $newImageName);

            echo '<script>
                alert("Successfully Update Product");
                window.location.href = "'.APP_URL.'?module=product&action=detail&product_id='.$id.'";
            </script>';

            if($old_image != '') {
                $imagePath = IMG_PATH . $old_image;
                unlink($imagePath);
            }
        }
    }

    // $product = new ProductController();
    // $product->editProduct($id, $name, $is_cod, $is_delivery, $price_cod, $price_delivery, $weight, $desc, $old_image);

    // echo 'check db';
}


?>
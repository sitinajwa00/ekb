<?php

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_admin.php';

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $desc = (isset($_POST['description']) ? $_POST['description'] : '');
    $qty = $_POST['quantity'];
    $weight = (isset($_POST['weight']) ? $_POST['weight'] : 'no');
    $is_cod = (isset($_POST['is_cod']) ? $_POST['is_cod'] : '0');
    $is_pos = (isset($_POST['is_pos']) ? $_POST['is_pos'] : '0');
    $price_cod = $_POST['codPrice'];
    $price_pos = $_POST['posPrice'];

    if ($_FILES['image']['error'] === 4) {
        $newImageName = '';

        $product = new AddProductPage();
        $product->enterProductDetails($name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $newImageName, $qty);

        echo '<script>
            alert("Successfully Add New Product");
            window.location.href = "'.APP_URL.'?module=product";
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
            
            $product = new AddProductPage();
            $product->enterProductDetails($name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $newImageName, $qty);

            echo '<script>
                alert("Successfully Add New Product");
                window.location.href = "'.APP_URL.'?module=product";
            </script>';


        }
    }
}

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php APP_URL ?>?module=product">Products</a></li>
                        <li class="breadcrumb-item active text-warning">Add Product</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <?php
        $addProduct = new AddProductPage();
        echo $addProduct->displayAddProductPage();
        ?>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
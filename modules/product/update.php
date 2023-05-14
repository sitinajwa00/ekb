<?php

if (!isset($_SESSION['login'])) {
    header('Location: ' . APP_URL . '?module=auth&action=login');
}

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_admin.php';

if (isset($_POST['save'])) {
    $id = $_GET['product_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $weight = (isset($_POST['weight']) ? $_POST['weight'] : 'no');
    $is_cod = (isset($_POST['is_cod']) ? $_POST['is_cod'] : '0');
    $is_pos = (isset($_POST['is_pos']) ? $_POST['is_pos'] : '0');
    $price_cod = $_POST['codPrice'];
    $price_pos = $_POST['posPrice'];
    $old_image = (isset($_POST['old_image']) ? $_POST['old_image'] : '');

    // echo '<script>alert('.$id.');</script>';

    if ($_FILES['image']['error'] === 4) {
        $newImageName = $old_image;

        $product = new EditProductPage();
        $product->editProduct($id, $name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $old_image);

        echo '<script>
            alert("Successfully Update Product");
            window.location.href = "'.APP_URL.'?module=product&action=update&product_id='.$id.'";
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
            
            $product = new EditProductPage();
            $product->editProduct($id, $name, $is_cod, $is_pos, $price_cod, $price_pos, $weight, $desc, $newImageName);

            echo '<script>
                alert("Successfully Update Product");
                window.location.href = "'.APP_URL.'?module=product&action=update&product_id='.$id.'";
            </script>';

            if($old_image != '') {
                $imagePath = IMG_PATH . $old_image;
                unlink($imagePath);
            }
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
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=product">Products</a></li>
                        <li class="breadcrumb-item active text-warning">Update Product</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <?php
        $product = new EditProductPage();
        echo $product->displayEditProductPage($_GET['product_id']);
        ?>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
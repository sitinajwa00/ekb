<?php

if (!isset($_SESSION['login'])) {
    header('Location: ' . APP_URL . '?module=auth&action=login');
}

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

$product = new ProductController();
$response = $product->displayProduct($_GET['product_id']);
$detail = $response[0];

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_admin.php';

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
        <form action="<?php echo APP_URL . '?module=product&action=submit&product_id=' . $detail['productID'] ?>" method="post" enctype="multipart/form-data">
            <div class="text-end mb-3">
                <button type="submit" name="save" class="btn btn-warning"><i class="fa-regular fa-floppy-disk"></i>&ensp;Save</button>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header">
                            <h5>General Information</h5>
                        </div>
                        <div class="card-body">
                            <!-- Image -->
                            <div class="text-center">
                            <img src="<?php echo ($detail['productImage']!='' ? IMG_URL . $detail['productImage'] : ASSET_URL . '/images/default_image.jpg') ?>" class="w-25 rounded mb-2" alt="">  
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Image</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="hidden" name="old_image" value="<?php echo $detail['productImage'] ?>">
                                    <input type="file" name="image" id="" class="form-control">
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="" class="form-control" value="<?php echo $detail['productName'] ?>" required>
                                </div>
                            </div>

                            <!-- Weight -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Weight</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="weight500" value="500" <?php echo ($detail['productWeight']=='500' ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="weight500">500g</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="weight1000" value="1000" <?php echo ($detail['productWeight']=='1000' ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="weight1000">1kg</label>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- Description -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Description</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" id="" rows="3"><?php echo $detail['productDesc'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h5>Service Type</h5>
                        </div>
                        <div class="card-body">
                            <label for="" class="form-label">Available service type:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="is_cod" type="checkbox" value="1" id="serviceCOD" <?php echo ($detail['is_cod']=='1' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="serviceCOD">
                                    Cash On Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="is_delivery" type="checkbox" value="1" id="serviceDelivery" <?php echo ($detail['is_delivery']=='1' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="serviceDelivery">
                                    Delivery
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Product Price</h5>
                        </div>
                        <div class="card-body">
                            <!-- COD -->
                            <div class="mb-3">
                                <label for="" class="form-label">Cash On Delivery:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="number" class="form-control" name="codPrice" placeholder="0.00" value="<?php echo $detail['productPriceCOD'] ?>">
                                </div>
                            </div>
                            <!-- Delivery -->
                            <div class="mb-3">
                                <label for="" class="form-label">Delivery:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="number" class="form-control" name="dvryPrice" placeholder="0.00" value="<?php echo $detail['productPriceDvry'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
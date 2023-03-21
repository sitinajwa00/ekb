<?php

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
                        <li class="breadcrumb-item"><a href="<?php APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php APP_URL ?>?module=product">Products</a></li>
                        <li class="breadcrumb-item active text-warning">Add Product</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <form action="<?php echo APP_URL ?>?module=product&action=submit" method="post" enctype="multipart/form-data">
            <div class="text-end mb-3">
                <button type="submit" name="submit" class="btn btn-warning"><i class="fa-regular fa-floppy-disk"></i>&ensp;Submit</button>
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
                            <img src="<?php echo ASSET_URL ?>images/default_image.jpg" class="w-25 rounded mb-2" alt="">  
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Image</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="" class="form-control">
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="" class="form-control" required>
                                </div>
                            </div>

                            <!-- Weight -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Weight</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="wieght500" value="500">
                                        <label class="form-check-label" for="wieght500">500g</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="weight1000" value="1000">
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
                                    <textarea name="description" class="form-control" id="" rows="3"></textarea>
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
                                <input class="form-check-input" name="is_cod" type="checkbox" value="1" id="serviceCOD">
                                <label class="form-check-label" for="serviceCOD">
                                    Cash On Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="is_pos" type="checkbox" value="1" id="servicePos">
                                <label class="form-check-label" for="servicePos">
                                    Postage
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
                                    <input type="number" class="form-control" name="codPrice" placeholder="0.00" min="0" step="0.01">
                                </div>
                            </div>
                            <!-- Postage -->
                            <div class="mb-3">
                                <label for="" class="form-label">Postage:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="number" class="form-control" name="posPrice" placeholder="0.00" min="0" step="0.01">
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
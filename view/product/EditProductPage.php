<?php 

class EditProductPage extends ProductController {
    public function displayEditProductPage($productID) {
        $req = $this->getProductDetails($productID);
        $detail = $req[0];

        ?>
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validate()">
            <div class="text-end mb-3">
                <button type="submit" name="save" class="btn btn-warning"><i class="fa-regular fa-floppy-disk"></i>&ensp;Update</button>
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
                            <img src="<?php echo ($detail['productImage']!='' ? IMG_URL . $detail['productImage'] : ASSET_URL . '/images/default_image.jpg') ?>" class="w-25 rounded mb-2 img-featured" alt="">  
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
                                    <label for="" class="form-label">Name *</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="" class="form-control name" value="<?php echo $detail['productName'] ?>">
                                </div>
                            </div>

                            <!-- Weight -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Weight *</label>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="weight400" value="400" <?php echo ($detail['productWeight']=='400' ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="weight400">400g</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="weight500" value="500" <?php echo ($detail['productWeight']=='500' ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="weight500">500g</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="weight" id="weight5000" value="5000" <?php echo ($detail['productWeight']=='5000' ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="weight5000">5kg</label>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- Description -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="" class="form-label">Description</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control desc" id="" rows="3"><?php echo $detail['productDesc'] ?></textarea>
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
                            <label for="" class="form-label">Available service type: *</label>
                            <div class="form-check">
                                <input class="form-check-input is_cod" name="is_cod" type="checkbox" value="1" id="serviceCOD" <?php echo ($detail['is_cod']=='1' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="serviceCOD">
                                    Cash On Delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input is_pos" name="is_pos" type="checkbox" value="1" id="servicePos" <?php echo ($detail['is_pos']=='1' ? 'checked' : '') ?>>
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
                                <label for="" class="form-label">Cash On Delivery: *</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="number" class="form-control cod-price" name="codPrice" placeholder="0.00" value="<?php echo $detail['productPriceCOD'] ?>" min="0" step="0.01">
                                </div>
                            </div>
                            <!-- Postage -->
                            <div class="mb-3">
                                <label for="" class="form-label">Postage: *</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="number" class="form-control pos-price" name="posPrice" placeholder="0.00" value="<?php echo $detail['productPricePos'] ?>" min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            $(document).ready(() => {
                $("input[name='image']").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $(".img-featured")
                            .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

            function validate() {
                if ($('.name').val()=='') {
                    alert('Please fill in the name!');
                    return false;
                }
                if ($('[name="weight"]:checked').val() == undefined) {
                    alert('Please select the weight!');
                    return false;
                }
                if (!$('[name="is_cod"]').is(':checked') && !$('[name="is_pos"]').is(':checked')) {
                    alert('Please tick at least 1 service!');
                    return false;
                }
                if ($('.cod-price').val()=='' || $('.pos-price').val()=='') {
                    alert('Please fill in the price!');
                    return false;
                }
                return (true);
            }
        </script>
        <?php
    }

    public function editProduct($id, $name, $is_cod, $is_pos, $price_cod, $price_delivery, $weight, $desc, $image) {
        $this->updateProductDetails($id, $name, $is_cod, $is_pos, $price_cod, $price_delivery, $weight, $desc, $image);
    }
}

?>
<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'about_us.inc.php';
require INCL_PATH . 'cart.inc.php';

$about_us = new AboutUsController();
$detail = $about_us->displayAboutUs();
$about_us_detail = $detail[0];

if (isset($_SESSION['user'])) {
    $cart = new CartController();
$result_cart = $cart->displayAllCartsByUser($_SESSION['user']['id']);
$cart_list = $result_cart;
$cartCount = count($cart_list);
}


// exit(json_encode($our_contact_detail));

require ASSET_PATH . 'header.php';
// require ASSET_PATH . ($_SESSION['user']['type'] == '2' ? 'sidenav_cust.php' : 'sidenav_admin.php');
$sidenav = 'sidenav.php';
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['type'] == '2')
        $sidenav = 'sidenav_cust.php';
    else 
        $sidenav = 'sidenav_admin.php';
}
require ASSET_PATH . $sidenav;

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-warning active">About Us</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] == '1') {?>
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <form action="<?php echo APP_URL ?>?module=about_us&action=submit" method="post" enctype="multipart/form-data">
                        <div class="card-header bg-warning text-light">Image</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded mb-2 img-featured" src="<?php echo ($about_us_detail['image']!='' ? IMG_URL . $about_us_detail['image'] : ASSET_URL . '/images/default_image.jpg') ?>" alt="" style="width:200px;object-fit:cover;cursor:pointer">
                            <input type="text" name="old_image" value="<?php echo $about_us_detail['image'] ?>" hidden>
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">Click <i class="fa-solid fa-hand-point-up"></i> to upload image</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-dark" type="submit" name="submit_image">Update Image</button>
                            <input type="file" name="image" id="" class="form-control" accept=".jpg, .jpeg, .png" value="" hidden>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <form action="<?php echo APP_URL ?>?module=about_us&action=submit" method="post">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-light">
                            About Us
                        </div>
                        <div class="card-body">
                            <!-- Form (About us) -->
                            <div class="mb-3">
                                <label for="" class="small mb-1">Who are we?</label>
                                <textarea type="text" class="form-control" name="who_are_we" placeholder=""><?php echo $about_us_detail['who_are_we'] ?></textarea>
                            </div>

                            <!-- Form (What we sell) -->
                            <div class="mb-3">
                                <label for="" class="small mb-1">What we sell?</label>
                                <textarea type="text" class="form-control" name="what_we_sell" placeholder=""><?php echo $about_us_detail['product_desc']?></textarea>
                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-dark" type="submit" name="submit_desc">Update Description</button>
                        </div>
                        <div class="card-header bg-warning text-light">
                            Our Contact
                        </div>
                        <div class="card-body">
                            <!-- Form (Phone Number) -->
                            <div class="mb-3">
                                <label for="" class="small mb-1">Contact</label>
                                <input type="tel" class="form-control" name="contact" placeholder="" value="<?php echo $about_us_detail['contact'] ?>" >
                            </div>

                            <!-- Form (Email) -->
                            <div class="mb-3">
                                <label for="" class="small mb-1">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="" value="<?php echo $about_us_detail['email'] ?>" >
                            </div>

                            <!-- Form (Location) -->
                            <div class="mb-3">
                                <label for="" class="small mb-1">Location</label>
                                <textarea type="text" class="form-control" name="location" placeholder=""><?php echo $about_us_detail['location'] ?></textarea>
                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-dark" type="submit" name="submit_contact">Update Contact</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php } else  {?>
        <div class="row">
            <div class="col-xl-5">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header bg-warning text-light">Image</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded mb-2 img-featured w-100" src="<?php echo ($about_us_detail['image']!='' ? IMG_URL . $about_us_detail['image'] : ASSET_URL . '/images/default_image.jpg') ?>" alt="" style="cursor:pointer">
                        <button type="button" name="btn_img_modal" data-bs-toggle="modal" data-bs-target="#storeImage" hidden> Button </button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="storeImage" tabindex="-1" aria-labelledby="storeImageLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="storeImageLabel">Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="w-100" src="<?php echo IMG_URL . $about_us_detail['image'] ?>" alt="ekb">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header bg-warning text-light">
                        About Us
                    </div>
                    <div class="card-body">
                        <!-- Form (About us) -->
                        <div class="mb-3">
                            <h5>Who are we?</h5>
                            <p><small><?php echo $about_us_detail['who_are_we'] ?></small></p>
                        </div>

                        <!-- Form (What we sell) -->
                        <div class="mb-3">
                            <h5>What we sell?</h5>
                            <p><small><?php echo $about_us_detail['product_desc']?></small></p>
                        </div>
                    </div>
                    <div class="card-header bg-warning text-light">
                        Our Contact
                    </div>
                    <div class="card-body">
                        <!-- Form (Phone Number) -->
                        <div class="mb-3">
                            <h5>Contact</h5>
                            <p><small><?php echo $about_us_detail['contact'] ?></small></p>
                        </div>

                        <!-- Form (Email) -->
                        <div class="mb-3">
                            <h5>Email</h5>
                            <p><small><?php echo $about_us_detail['email'] ?></small></p>
                        </div>

                        <!-- Form (Location) -->
                        <div class="mb-3">
                            <h5>Location</h5>
                            <p><small><?php echo $about_us_detail['location'] ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                // My Cart Badge
                var cart_count = <?php echo $cartCount; ?>;
                $('.my-cart-badge').html(cart_count);
                if (cart_count > 0)
                    $('.my-cart-badge-2').html('My Cart&emsp;<span class="badge badge-warning">'+cart_count+'</span>');
            });
        </script>
        <?php }?>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
    $(document).ready(function() {
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

        $('.img-featured').click(function() {
            $('[name="image"]')[0].click();
            $('[name="btn_img_modal"]')[0].click();
        });
    });
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
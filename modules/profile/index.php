<?php

if (!isset($_SESSION['login'])) {
    header('Location: ' . APP_URL . '?module=auth&action=login');
}

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';

$user = new UserController();
$response = $user->displayUser($_SESSION['user']['id']);
$detail = $response[0];

require ASSET_PATH . 'header.php';
if ($_SESSION['user']['type'] == 0) {
    require ASSET_PATH . 'sidenav_owner.php';
} else if ($_SESSION['user']['type'] == 1) {
    require ASSET_PATH . 'sidenav_admin.php';
} else if ($_SESSION['user']['type'] == 2) {
    require ASSET_PATH . 'sidenav_cust.php';
}

$state = array(
    'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
    'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
);

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
                        <li class="breadcrumb-item active"><a href="<?php echo APP_URL ?>?module=profile">Profile</a></li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="mt-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded mb-2" src="<?php echo ASSET_URL ?>images/default_image.jpg" alt="" style="width:200px;object-fit:cover">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form action="<?php echo APP_URL . '?module=' . $_GET['module'] . '&action=submit' ?>" method="post">
                                <!-- Form (Name) -->
                                <div class="mb-3">
                                    <label for="" class="small mb-1">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $detail['userName'] ?>" required>
                                </div>

                                <!-- Form Row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (Email) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $detail['userEmail'] ?>" required>  
                                    </div>
                                    
                                    <!-- Form Group (Phone) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Phone Number</label>
                                        <input type="text" class="form-control" name="phonenum" placeholder="Tel" value="<?php echo $detail['userPhonenum'] ?>" required>
                                    </div>
                                </div>

                                <!-- Form (Address) -->
                                <div class="mb-3">
                                    <label for="" class="small mb-1">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $detail['userAddress'] ?>" required>
                                </div>

                                <!-- Form row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (Poscode) -->
                                    <div class="col-md-4">
                                        <label for="" class="small mb-1">Posocde</label>
                                        <input type="number" class="form-control" name="poscode" value="<?php echo $detail['userPoscode'] ?>">
                                    </div>

                                    <!-- Form Group (City) -->
                                    <div class="col-md-4">
                                        <label for="" class="small mb-1">City</label>
                                        <input type="text" class="form-control" name="city" value="<?php echo $detail['userCity'] ?>">    
                                    </div>

                                    <!-- Form Group (State) -->
                                    <div class="col-md-4">
                                        <label for="" class="small mb-1">State</label>
                                        <select name="state" id="" class="form-select">
                                            <?php foreach ($state as $i=>$val) {?>
                                            <option value="<?php echo $i ?>"><?php echo $val ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                </div>

                                <!-- Form Row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (Password) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Password</label>
                                        <input type="password" id="" class="form-control" name="pwd" value="">
                                    </div>

                                    <!-- Form Group (Confirm Password) -->
                                    <div class="col-md-6">
                                        <label for="" class="small mb-1">Confirm Password</label>
                                        <input type="password" id="" class="form-control" name="confirm_pwd" value="">
                                    </div>
                                </div>

                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit" name="submit">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<?php

require ASSET_PATH . 'footer.php';

?>
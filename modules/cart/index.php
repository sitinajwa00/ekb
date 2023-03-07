<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';

$user = new UserController();
$result = $user->displayUser($_SESSION['user']['id']);
$user_detail = $result[0];

$state_arr = array(
    'johor'=>'Johor', 'kedah'=>'Kedah', 'kelantan'=>'Kelantan', 'melaka'=>'Melaka', 'n9'=>'Negeri Sembilan', 'pahang'=>'Pahang', 'perak'=>'Perak',
    'perlis'=>'Perlis', 'pp'=>'Pulau Pinang', 'sabah'=>'Sabah', 'sarawak'=>'Sarawak', 'terengganu'=>'Terengganu', 'kl'=>'W.P. Kuala Lumpur', 'labuan'=>'W.P. Labuan', 'pj'=>'W.P. Putrajaya' 
);

foreach($state_arr as $i=>$val) {
    if ($user_detail['userState'] == $i) {
        $state = $val;
        break;
    }
}

$address = $user_detail['userAddress'] . ', ' . $user_detail['userPoscode'] . ', ' . $user_detail['userCity'] . ', ' . $state;

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_cust.php';

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="row">
                <div class="col-8">
                    <!-- <div class="card">
                        <div class="card-body"> -->
                            <table class="table">
                                <thead>
                                    <tr class="bg-secondary">
                                        <th></th>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th class="col-2">Quantity</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td class="col-2"><img src="<?php echo ASSET_URL ?>images/default_image.jpg" alt="" class="w-100"></td>
                                        <td>Original<br><small>COD</small></td>
                                        <td data-price="9.00">RM9.00</td>
                                        <td><input type="number" class="form-control qty" min="0" value="2"></td>
                                        <td>RM18.00</td>
                                        <td><i class="fa-solid fa-trash"></i></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><img src="<?php echo ASSET_URL ?>images/default_image.jpg" alt="" class="w-100"></td>
                                        <td>Salted Egg<br><small>Delivery</small></td>
                                        <td data-price="9.00">RM9.00</td>
                                        <td><input type="number" class="form-control qty" min="0" value="3"></td>
                                        <td>RM27.00</td>
                                        <td><i class="fa-solid fa-trash"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- </div>
                    </div> -->
                </div>
                <div class="col-4">
                    <div class="card">
                      <div class="card-header bg-secondary text-light px-4 py-1"><i class="fa-solid fa-location-crosshairs"></i> Shipping Address</div>
                        <div class="card-body pt-1">
                          <span class="fw-bold"><small><?php echo $_SESSION['user']['name'] ?></small></span><br>
                          <span><small><?php echo $address ?></small></span>
                        </div>
                        <div class="bg-secondary text-light px-4 py-1"><i class="fa-solid fa-dollar-sign"></i> Price Details</div>
                        <div class="card-body pt-1">
                            <div class="fw-bold">COD</div>
                            <div class="d-flex flex-row justify-content-between">
                                <div>Original x1</div>
                                <div>RM9.00</div>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <div>Salted Egg x1</div>
                                <div>RM11.00</div>
                            </div>
                            <div class="fw-bold">Delivery</div>
                            <div class="d-flex flex-row justify-content-between">
                                <div>Original x3</div>
                                <div>RM9.00</div>
                            </div>
                            <hr>
                            <div class="d-flex flex-row justify-content-between">
                                <div>Total</div>
                                <div>RM29.00</div>
                            </div>
                            <div class="mt-3 text-end">
                                <span class="btn btn-dark">Check Out</span>
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
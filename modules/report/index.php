<?php

// require INCL_PATH . 'db.inc.php';
// require INCL_PATH . 'user.inc.php';

// $cust = new UserController();
// $response = $cust->displayAllCustomers();
// exit(json_encode($response));

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'report.inc.php';

// keyword
// tsd = total sale daily
// tsm = total sale monthly

$report = new ReportController();
$result_tsd_cod = $report->displayTotalSalesDaily('COD');  

$report = new ReportController();
$result_tsm_cod = $report->displayTotalSalesByMonth('COD');

require ASSET_PATH . 'header.php';
if ($_SESSION['user']['type'] == 0)
    require ASSET_PATH . 'sidenav_owner.php';
else if ($_SESSION['user']['type'] == 1) 
    require ASSET_PATH . 'sidenav_admin.php';

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-3">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-warning active">Sales Report</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="d-flex flex-row justify-content-around mt-4 h-100">
            <div class="card col-5 me-2">
                <div class="card-body d-flex flex-column justify-content-between" onclick="window.location.href='<?php echo APP_URL ?>?module=report&action=daily'" style="cursor:pointer;">
                    <img src="<?php echo ASSET_URL ?>/images/freepik/charts.jpg" alt="" class="w-100">
                    <button class="btn btn-dark w-100">Daily Sales Report</button>
                </div>
            </div>
            <div class="card col-5">
                <div class="card-body text-center" onclick="window.location.href='<?php echo APP_URL ?>?module=report&action=monthly'" style="cursor:pointer;">
                    <img src="<?php echo ASSET_URL ?>/images/freepik/dividend.jpg" alt="" class="w-75">
                    <button class="btn btn-dark w-100">Monthly Sales Report</button>
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
<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'report.inc.php';

$report = new ReportController();
$result_cod = $report->displayTotalSalesByMonth('COD');

$report = new ReportController();
$result_pos = $report->displayTotalSalesByMonth('Postage');

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
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=report">Sales Report</a></li>
                        <li class="breadcrumb-item">Monthly Sales Report</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div>
                <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-cod-tab" data-bs-toggle="pill" href="#pills-cod" role="tab" aria-controls="pills-cod" aria-selected="true">COD</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-pos-tab" data-bs-toggle="pill" href="#pills-pos" role="tab" aria-controls="pills-pos" aria-selected="false">Postage</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                        <div class="card mb-3">
                            <div class="card-body p-0">
                            <table id="table-1" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Delivery Type</th>
                                        <th class="text-end">Total Sales (RM)</th>
                                    </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-pos" role="tabpanel" aria-labelledby="pills-pos-tab">
                        <div class="card mb-3">
                            <div class="card-body p-0">
                            <table id="table-2" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Delivery Type</th>
                                        <th class="text-end">Total Sales (RM)</th>
                                    </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
$(document).ready(function () {
    $('#table-1').DataTable({
        data: <?php echo json_encode($result_cod) ?>,
        src: 'data',
        columns: [
            { data: 'Year' },
            { data: 'Month' },
            { data: 'Delivery_Type' },
            { data: 'Total_Sales' },
        ],
        columnDefs: [
            {
                targets: -1,
                render: function (data, type, full, meta) {
                    return('<div class="text-end"><span>'+data+'</span></div>');
                }
            }
                
        ],
        dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center py-2 mx-0 row my-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    });

    $('#table-2').DataTable({
        data: <?php echo json_encode($result_pos) ?>,
        src: 'data',
        columns: [
            { data: 'Year' },
            { data: 'Month' },
            { data: 'Delivery_Type' },
            { data: 'Total_Sales' },
        ],
        columnDefs: [
            {
                targets: -1,
                render: function (data, type, full, meta) {
                    return('<div class="text-end"><span>'+data+'</span></div>');
                }
            }
                
        ],
        dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center py-2 mx-0 row my-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    });
});
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
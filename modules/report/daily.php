<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'report.inc.php';

$month = date('m');
$monthName = date('M');
$year = date('Y');

// Total Sales Daily - COD & Postage
$report = new ReportController();
$result_cod = $report->displayTotalSalesDaily('COD');  

$report = new ReportController();
$result_pos = $report->displayTotalSalesDaily('Postage');

// Total Sales by Month - COD & Postage
$sales = new ReportController();
$monthly_sales_cod = $sales->displayTotalSalesDailyByMonth('COD', $month, $year); 
$total_sales_cod = getTotalSales($monthly_sales_cod); 

$sales = new ReportController();
$monthly_sales_pos = $sales->displayTotalSalesDailyByMonth('Postage', $month, $year);
$total_sales_pos = getTotalSales($monthly_sales_pos);

function getTotalSales($sales) {
    $total = 0.0;
    foreach ($sales as $val) {
        $total += (double)$val['Total_Sales'];
    }

    return $total;
}

require ASSET_PATH . 'header.php';
if ($_SESSION['user']['type'] == 0)
    require ASSET_PATH . 'sidenav_owner.php';
else if ($_SESSION['user']['type'] == 1) 
    require ASSET_PATH . 'sidenav_admin.php';

if (isset($_POST['filter_cod']) && isset($_GET['filter'])) {
    $year = $_POST['datepicker'];
    $month = $_POST['month'];

    $report = new ReportController();
    $result_cod = $report->displayTotalSalesDailyByMonth('COD', $month, $year);
    $result_pos = $report->displayTotalSalesDailyByMonth('Postage', $month, $year);

    $total_sales_cod = getTotalSales($result_cod); 
    $total_sales_pos = getTotalSales($result_pos); 

    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    foreach ($months as $month_index => $m) {
        if (($month-1) == $month_index)
            $monthName = $m;
    }

    echo '<script>
        $(document).ready(function() {
            $(".month_year").html("'.$monthName.' '.$year.'");
            $(".total_monthly_sales_cod").html("RM '.$total_sales_cod.'");
            $(".total_monthly_sales_pos").html("RM '.$total_sales_pos.'");
        });
    </script>';
    // echo '<script>alert("'.$year . $month.'");</script>';
} 
// else if (isset($_POST['filter_pos']) && isset($_GET['filter'])) {
//     $year = $_POST['datepickerPos'];
//     $month = $_POST['monthPos'];

//     $report = new ReportController();
//     $result_pos = $report->displayTotalSalesDailyByMonth('Postage', $month, $year);
    
//     echo '<script>
//         $(function(){
//             $("#pills-postage-tab")[0].click();
//         });
//     </script>';
// }
    
    
?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-3">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=report">Sales Report</a></li>
                        <li class="breadcrumb-item text-warning active">Daily Sales Report</li>
                    </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div>
            <h2 class="month_year"><?php echo $monthName . ' ' . $year ?></h2>
        </div>
        <div>
            <span class="btn btn-icon btn-outline-dark" data-bs-toggle="modal" data-bs-target="#filter"><i class="fa-solid fa-filter"></i> Filter</span>
        </div>
        <!-- Modal -->
        <form action="<?php echo APP_URL ?>?module=report&action=daily&filter=1" method="post">
            <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filterLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="" class="form-label">Year</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name="datepicker" id="datepicker" placeholder="Choose a year"/>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="" class="form-label">Month</label>
                            </div>
                            <div class="col-8">
                                <select name="month" id="" class="form-select">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="filter_cod" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <div>
                <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-cod-tab" data-bs-toggle="pill" href="#pills-cod" role="tab" aria-controls="pills-cod" aria-selected="true">COD</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-postage-tab" data-bs-toggle="pill" href="#pills-postage" role="tab" aria-controls="pills-postage" aria-selected="false">postage</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                        <div class="card mb-3">
                            <div class="card-body p-0">
                            <table id="table-1" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th class="text-end">Sales (RM)</th>
                                    </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-postage" role="tabpanel" aria-labelledby="pills-postage-tab">
                        <div class="card mb-3">
                            <div class="card-body p-0">
                            <table id="table-2" class="table bg-white" style="width:100%">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>Date</th>
                                        <th>Delivery Type</th>
                                        <th class="text-end">Sales (RM)</th>
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
    // $('#pills-postage-tab')[0].click();

    $('#table-1').DataTable({
        data: <?php echo json_encode($result_cod) ?>,
        src: 'data',
        columns: [
            { data: 'Date' },
            { data: 'Delivery_Type' },
            { data: 'Total_Sales' },
        ],
        columnDefs: [
            {
                targets: -1,
                render: function (data, type, full, meta) {
                    return('<div class="text-end"><span>'+parseFloat(data).toFixed(2)+'</span></div>');
                }
            }
                
        ],
        dom: '<"card-header border-bottom p-1"<"head-label head-label-cod d-flex flex-row justify-content-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center py-2 mx-0 row my-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    });

    $(function(){
        // var d = new Date();
        // var month = d.getMonth(); 
        // var year = d.getFullYear();

        // var month_year = '<span>Sales in: '+month+' '+year+'</span>';

        // var filter_cod = '<span class="btn btn-icon btn-dark" data-bs-toggle="modal" data-bs-target="#filter"><i class="fa-solid fa-filter"></i> Filter</span>';

        // $('.head-label-cod').append(month_year);
        // $('.head-label-cod').append(filter_cod);

        var monthly_sales = '<div class="text-center">'+
            '<div class="fw-bold">Total Sales</div>'+
            '<div class="total_sales_monthly_cod">RM '+<?php echo $total_sales_cod ?>+'</div>'+
        '</div>';

        $('.head-label-cod').append(monthly_sales);
    });

    $('#table-2').DataTable({
        data: <?php echo json_encode($result_pos) ?>,
        src: 'data',
        columns: [
            { data: 'Date' },
            { data: 'Delivery_Type' },
            { data: 'Total_Sales' },
        ],
        columnDefs: [
            {
                targets: -1,
                render: function (data, type, full, meta) {
                    return('<div class="text-end"><span>'+parseFloat(data).toFixed(2)+'</span></div>');
                }
            }
                
        ],
        dom: '<"card-header border-bottom p-1"<"head-label head-label-pos"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center py-2 mx-0 my-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
    });

    $(function(){
        // var filter_pos = '<span class="btn btn-icon btn-dark" data-bs-toggle="modal" data-bs-target="#filterPos"><i class="fa-solid fa-filter"></i> Filter</span>';

        // $('.head-label-pos').append(filter_pos);

        var monthly_sales = '<div class="text-center">'+
            '<div class="fw-bold">Total Sales</div>'+
            '<div class="total_sales_monthly_pos">RM '+<?php echo $total_sales_pos ?>+'</div>'+
        '</div>';

        $('.head-label-pos').append(monthly_sales);
    });
});

$(document).ready(function(){
    var d = new Date();
    var year = d.getFullYear();
  $("#datepicker").datepicker({
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
    //  updateViewDate: true,
    //  changeYear: true,
    //  defaultViewDate: {year: '2023'},
     autoclose:true
  });   
})
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
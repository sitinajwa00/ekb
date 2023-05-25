<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'order.inc.php';

$order = new OrderController();
$response = $order->displayOrderList();
// exit(json_encode($response));

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_owner.php';

?>

<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="mb-3">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active text-warning">Order List</li>
                      </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div>
          <table id="example" class="table bg-white" style="width:100%">
            <thead>
              <tr class="bg-primary text-light">
                <th>Order ID</th>
                <th>Date</th>
                <!-- <th>Customer</th> -->
                <th>Item</th>
                <th>Delivery Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
        <!-- END: Content -->
    </div>
</main>
<!--Main layout-->

<script>
// $(document).ready(function() {
//     $('#dTable').DataTable();
// });

$(document).ready(function () {
    $('#example').DataTable({
    data: <?php echo json_encode($response) ?>,
    src: 'data',
    columns: [
        { data: 'orderID' },
        { data: 'date' },
        // { data: 'userName' },
        { data: 'orderItem' },
        { data: 'deliveryType' },
        { data: 'orderStatus' },
        { data: '' }
    ],
    order: [[0, 'desc']],
    columnDefs: [
        {
            targets: 0,
            render: function (data, type, full, meta) {
                return ('<span data-id="'+full['orderID']+'">'+data+'</span>');
            }
        },
        {
            targets: 2,
            render: function (data, type, full, meta) {
                return (data.slice(0, -2));
            }
        },
        {
            targets: -2,
            render: function (data, type, full, meta) {
                var color = '';
                switch (data) {
                    case 'Pending': 
                        color = 'badge-danger';
                        break;
                    case 'Processing':
                        color = 'badge-warning';
                        break;
                    case 'To Ship':
                        color = 'badge-light';
                        break;
                    case 'Out For Delivery':
                        color = 'badge-primary';
                        break;
                    case 'Complete':
                        color = 'badge-success';
                        break;
                    default:
                        color = '';
                }
                return ('<span class="badge '+color+'">'+data+'</span>');
            }
        },
        {
            targets: -1,
            render: function(data, type, full, meta) {
                return (
                    '<div class="d-flex flex-row justify-content-end">' +
                        '<a href="<?php echo APP_URL ?>?module=order&action=detail&order_id='+full['orderID']+'"><span class="btn btn-warning me-1">View</span></a>' +
                    '</div>'
                );
            }
        }
    ],
    dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    });
});
</script>

<?php

require ASSET_PATH . 'footer.php';

?>
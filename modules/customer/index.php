<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'user.inc.php';

$cust = new UserController();
$response = $cust->displayAllCustomers();
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
                        <li class="breadcrumb-item text-warning active">Customer List</li>
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
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
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
        { data: 'userName' },
        { data: 'userEmail' },
        { data: 'userPhonenum' },
        { data: 'userAddress' },
        { data: '' }
    ],
    columnDefs: [
        {
        targets: 0,
        render: function (data, type, full, meta) {
            return ('<span data-id="'+full['userID']+'">'+data+'</span>');
        }
        },
        {
        targets: -1,
        render: function(data, type, full, meta) {
            return (
                '<div class="d-flex flex-row justify-content-end">' +
                    '<a href="<?php echo APP_URL ?>?module=customer&action=detail&cust_id='+full['userID']+'"><span class="btn btn-warning me-1">View</span></a>' +
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
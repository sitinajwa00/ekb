<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

$cust = new ProductController();
$response = $cust->displayAllProducts();
// exit(json_encode($response));

require ASSET_PATH . 'header.php';
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
                      </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="d-flex flex-row justify-content-end">
            <a href="insert.php"><span class="btn btn-primary">Add New</span></a>
        </div>

        <div>
          <table id="example" class="table bg-white" style="width:100%">
            <thead>
              <tr class="bg-primary text-light">
                <th></th>
                <th>Name</th>
                <th>Current Qty</th>
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
        { data: 'productImage' },
        { data: 'productName' },
        { data: 'productQty' },
        { data: '' }
    ],
    columnDefs: [
        {
            targets: 0,
            orderable: false,
            render: function (data, type, full, meta) {
                var src = (data!='' ? '<?php echo IMG_URL ?>'+data : '<?php echo ASSET_URL . "images/default_image.jpg" ?>')
                return ('<span data-id="'+full['productID']+'"><img class="rounded" src="'+src+'" style="width:80px;height:80px;object-fit:cover;"></span>');
            }
        },
        {
            targets: -2,
            render: function(data, type, full, meta) {
                return (data<=10 ? '<span class="text-danger">'+data+'</span>' : data);
            }
        },
        {
            targets: -1,
            render: function(data, type, full, meta) {
                return (
                    '<div>' +
                        '<a href="<?php echo APP_URL ?>?module=stock&action=detail&product_id='+full['productID']+'"><span class="btn btn-warning me-1">Add Stock</span></a>' +
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
<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

$product = new ProductController();
$response = $product->displayAllProducts();
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
                        <li class="breadcrumb-item"><a href="<?php echo APP_URL ?>?module=home&action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item text-warning active">Products</li>
                      </ol>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- BEGIN: Content -->
        <div class="d-flex flex-row justify-content-end">
            <a href="<?php echo APP_URL ?>?module=product&action=insert"><span class="btn btn-warning">Add New</span></a>
        </div>

        <div>
          <table id="dTable" class="table bg-white" style="width:100%">
            <thead>
              <tr class="bg-dark text-light">
                <th></th>
                <th>Name</th>
                <th>Price (COD)</th>
                <th>Price (Delivery)</th>
                <th>Weight</th>
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
    $('#dTable').DataTable({
    data: <?php echo json_encode($response) ?>,
    src: 'data',
    columns: [
        { data: 'productImage' },
        { data: 'productName' },
        { data: 'productPriceCOD' },
        { data: 'productPriceDvry' },
        { data: 'productWeight' },
        { data: '' }
    ],
    columnDefs: [
        {
        targets: 0,
        orderable: false,
        render: function (data, type, full, meta) {
            return ('<span data-id="'+full['productID']+'"><img class="rounded" src="<?php echo IMG_URL ?>'+data+'" style="width:80px;height:100px;object-fit:cover;"></span>');
        }
        },
        {
        targets: -1,
        render: function(data, type, full, meta) {
            return (
                '<div class="d-flex flex-row justify-content-end">' +
                    '<a href="<?php echo APP_URL ?>?module=product&action=detail&product_id='+full['productID']+'"><span class="btn btn-outline-warning me-1">Update</span></a>' +
                    '<span class="btn btn-outline-dark item-delete" data-id="'+full['productID']+'">Delete</span>' +
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
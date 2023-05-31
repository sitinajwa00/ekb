<?php

require INCL_PATH . 'db.inc.php';
require INCL_PATH . 'product.inc.php';

$cust = new ProductController();
$response = $cust->displayAllProducts();
// exit(json_encode($response));

require ASSET_PATH . 'header.php';
require ASSET_PATH . 'sidenav_admin.php';

if (isset($_POST['submit'])) {
    $addProd = new ProductController();
    $addProd->addQty($_POST['productID'], (int)$_POST['qty']);

    echo '<script>
        alert("Successfully add stock quantity.");
        window.location.href = "'.APP_URL.'?module=stock";
    </script>';
}

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

        <!-- Modal -->
        <form action="" method="post">
            <div class="modal modal-add-stock fade" id="" tabindex="-1" aria-labelledby="addStockModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addStockModal">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Product ID -->
                            <input type="hidden" name="productID" id="" class="form-control" value="">
                        <!-- Product Current Qty -->
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="form-label">Current Quantity:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="" id="" class="form-control modal-curr-qty" value="" disabled>
                            </div>
                        </div>
                        <!-- Add Qty -->
                        <div class="row">
                            <div class="col-4">
                                <label for="" class="form-label">No. of stock added:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="qty" id="" class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-warning">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
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
                return (data<=20 ? data+'&emsp;<span class="badge badge-danger">Low stock</span>' : data);
            }
        },
        {
            targets: -1,
            render: function(data, type, full, meta) {
                return (
                    // '<div>' +
                    //     '<a href="<?php echo APP_URL ?>?module=stock&action=detail&product_id='+full['productID']+'"><span class="btn btn-warning me-1">Add Stock</span></a>' +
                    // '</div>'
                    '<div>' +
                        '<button type="button" class="btn btn-add-stock btn-warning" data-id="'+full['productID']+'" data-name="'+full['productName']+'" data-current-qty="'+full['productQty']+'" data-bs-toggle="modal" data-bs-target="#id'+full['productID']+'">Add Stock</button>' +
                    '</div>'
                );
            }
        }
    ],
    dom: '<"mb-3"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 mb-3 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    });
});

$(document).ready(function(){
    $('.btn-add-stock').mouseover(function(){
        var product_id = $(this).attr('data-id');
        var product_name = $(this).attr('data-name');
        var product_qty = $(this).attr('data-current-qty');
        
        $('.modal-add-stock').attr('id', 'id'+product_id);
        $('input[name="productID"]').attr('value', product_id);
        $('.modal-title').html('Add Stock for: '+product_name);
        $('.modal-curr-qty').attr('value', product_qty);
    });

    $("input[name='qty']").TouchSpin({
        initval: 0,
        min: 0,
        max: 1000,
        step: 1,
        // decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        buttondown_class: 'btn btn-dark h-100',
        buttonup_class: 'btn btn-dark h-100',
    });
});

</script>

<?php

require ASSET_PATH . 'footer.php';

?>
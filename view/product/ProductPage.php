<?php

class ProductPage extends ProductController {
    public function displayProductPage() {
        $response = $this->displayAllProducts();

        ?>

        <div class="d-flex flex-row justify-content-end">
            <a href="<?php echo APP_URL ?>?module=product&action=insert"><span class="btn btn-warning">Add Product</span></a>
        </div>

        <div>
          <table id="dTable" class="table bg-white" style="width:100%">
            <thead>
              <tr class="bg-dark text-light">
                <th></th>
                <th>Name</th>
                <th class="service">Service</th>
                <th>Price (COD)</th>
                <th>Price (Postage)</th>
                <th>Weight</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
          </table>
        </div>

        <script>
            $(document).ready(function () {
                $('#dTable').DataTable({
                data: <?php echo json_encode($response) ?>,
                src: 'data',
                columns: [
                    { data: 'productImage' },
                    { data: 'productName' },
                    { data: '' },
                    { data: 'productPriceCOD' },
                    { data: 'productPricePos' },
                    { data: 'productWeight' },
                    { data: '' }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            var src = (data!='' ? '<?php echo IMG_URL ?>'+data : '<?php echo ASSET_URL . "images/default_image.jpg" ?>')
                            return ('<span data-id="'+full['productID']+'"><img class="rounded" src="'+src+'" style="width:80px;height:100px;object-fit:cover;"></span>');
                        }
                    },
                    {
                        targets: 'service',
                        render: function(data, type, full, meta) {
                            var service_cod = '';
                            var service_pos = '';
                            if (full['is_cod'] == 1) {
                                service_cod = '<span class="badge badge-primary">COD</span><br>';
                            }
                            if (full['is_pos'] == 1) {
                                service_pos = '<span class="badge badge-success">Postage</span>';
                            }
                            return (
                                service_cod + service_pos
                            );
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

            $(document).on('click', '.item-delete', function(){
                var product_id = $(this).attr('data-id');
                var text = 'Are you sure to delete this product?';
                if (confirm(text) == true) {
                    $(location).attr('href', '<?php echo APP_URL ?>?module=product&action=submit&product_id='+product_id);
                }
            });
        </script>

        <?php

        // $data['message'] = 'Successful';
        // $data['status'] = true;
        // $data['result'] = $response;

        // return $data;
    }
}

?>
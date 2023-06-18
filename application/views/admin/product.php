<div class="container p-5">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" href="#addProductModal">
                Add Product
            </button>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <tr>
                        <td colspan="7" class="text-center">Data Not Found</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Product</h4>
            </div>
            <div class="modal-body p-5">
                <form id="formAddProduct" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select class="form-control" id="brand" name="brand">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnAddProduct">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        getData()
    });

    function getData() {
        $.ajax({
            url: "<?php echo base_url('admin/get_products'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var products = response.products;
                var tableBody = $('#productTable');

                $.each(products, function(index, product) {
                    var row = $('<tr>');
                    row.append($('<td>').text(product.id));
                    row.append($('<td>').text(product.type));
                    row.append($('<td>').text(product.name));
                    row.append($('<td>').text(product.brand_name));
                    row.append($('<td>').text(product.harga));
                    row.append($('<td>').text(product.stok));
                    row.append($('<td>').text(product.image));

                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
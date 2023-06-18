<div class="container p-5">
    <div class="row">
        <div class="col-md-12 pl-5">
            <h4>Product</h4>
        </div>
        <div class="col-md-12 p-5">
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
                        <th>Action</th>
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
                        <label>Brand</label>
                        <select class="form-control" id="brand" name="brand">
                            <?php foreach ($brand as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
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
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <form id="formEditProduct" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="editProductID">
                    <div class="form-group">
                        <label for="editType">Type</label>
                        <input type="text" class="form-control" id="editType" name="type">
                    </div>
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="editHarga">Harga</label>
                        <input type="number" class="form-control" id="editHarga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="editStok">Stok</label>
                        <input type="number" class="form-control" id="editStok" name="stok">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateProduct">Update</button>
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
        $('#productTable').html('')
        $.ajax({
            url: "<?php echo base_url('admin/get_products'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var products = response.products;
                var tableBody = $('#productTable');
                var a = 1
                $.each(products, function(index, product) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(product.type));
                    row.append($('<td>').text(product.name));
                    row.append($('<td>').text(product.brand_name));
                    row.append($('<td>').text(product.harga));
                    row.append($('<td>').text(product.stok));
                    row.append($('<td>').html('<a href="<?= base_url() ?>upload/product/' + product.image + '" target="_blank"><img src="<?= base_url() ?>upload/product/' + product.image + '" style="width:20px;height:20px;object-fit:cover"></a>'));
                    row.append($('<td>').html('<button class="btn btn-sm bg-warning" onclick="editData(' + product.id + ')">Edit</button><button class="btn btn-sm bg-danger" onclick="hapusData(' + product.id + ')">Hapus</button>'));
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $(document).on('click', '#btnAddProduct', function(e) {
        var form = $('#formAddProduct')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/add_product') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('.modal').modal('hide');
                getData()
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    function hapusData(product_id) {
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: "<?php echo base_url('admin/delete_product'); ?>",
                method: "POST",
                data: {
                    product_id: product_id
                },
                dataType: "json",
                success: function(response) {
                    getData()
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    function editData(product_id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_product_id'); ?>",
            method: "POST",
            data: {
                product_id: product_id
            },
            dataType: "json",
            success: function(response) {
                var product = response.product;
                // Isi nilai-nilai input form dengan data produk yang diambil
                $('#editProductModal #editProductID').val(product.id);
                $('#editProductModal #editType').val(product.type);
                $('#editProductModal #editName').val(product.name);
                $('#editProductModal #editHarga').val(product.harga);
                $('#editProductModal #editStok').val(product.stok);

                // Tampilkan modal edit produk
                $('#editProductModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $(document).on('click', '#btnUpdateProduct', function(e) {
        var form = $('#formEditProduct')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/update_product') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('#editProductModal').modal('hide');
                getData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
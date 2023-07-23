<div class="container p-5">
    <div class="row">
        <div class="col-md-12 pl-5">
            <h4>Spare Part</h4>
        </div>
        <div class="col-md-12 p-5">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" href="#addProductModal">
                Add Spare Part
            </button>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <tr>
                        <td colspan="6" class="text-center">Data Not Found</td>
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
            <div class="modal-body p-5" style="height: 100% !important;">
                <form id="formAddProduct" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="type">Name</label>
                        <input type="text" class="form-control" id="name_spare_part" name="name_spare_part">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual">
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
                    <input type="hidden" name="id" id="editProductID">
                    <div class="form-group">
                        <label for="type">Name</label>
                        <input type="text" class="form-control" id="name_spare_part" name="name_spare_part">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual">
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
            url: "<?php echo base_url('admin/get_spare_part'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var products = response;
                var tableBody = $('#productTable');
                var a = 1
                $.each(products, function(index, product) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(product.nama_spare_part));
                    row.append($('<td>').text(product.stok));
                    row.append($('<td>').text(product.biaya_beli));
                    row.append($('<td>').text(product.biaya_jual));
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
            url: '<?= base_url('admin/add_spare_part') ?>',
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

    function hapusData(id) {
        if (confirm('Are you sure you want to delete this Spare Part?')) {
            $.ajax({
                url: "<?php echo base_url('admin/delete_spare_part'); ?>",
                method: "POST",
                data: {
                    id: id
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

    function editData(id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_spare_part_id'); ?>",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                var product = response;
                // Isi nilai-nilai input form dengan data produk yang diambil
                $('#editProductModal #editProductID').val(product.id);
                $('#editProductModal #name_spare_part').val(product.nama_spare_part);
                $('#editProductModal #stok').val(product.stok);
                $('#editProductModal #harga_beli').val(product.biaya_beli);
                $('#editProductModal #harga_jual').val(product.biaya_jual);

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
            url: '<?= base_url('admin/update_spare_part') ?>',
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
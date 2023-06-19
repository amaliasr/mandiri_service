<div class="container p-5">
    <div class="row">
        <div class="col-md-12 pl-5">
            <h4>Service</h4>
        </div>
        <div class="col-md-12 p-5">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" href="#addBrandModal">
                Add Brand
            </button>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="brandTable">
                    <tr>
                        <td colspan="7" class="text-center">Data Not Found</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addBrandModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Brand</h4>
            </div>
            <div class="modal-body p-5">
                <form id="formAddBrand">
                    <div class="form-group">
                        <label for="type">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnAddBrand">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <form id="formEditBrand" enctype="multipart/form-data">
                    <input type="hidden" name="brand_id" id="editBrandID">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateBrand">Update</button>
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
        $('#brandTable').html('')
        $.ajax({
            url: "<?php echo base_url('admin/get_brands'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var brands = response;
                var tableBody = $('#brandTable');
                var a = 1
                $.each(brands, function(index, brand) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(brand.name));
                    row.append($('<td>').html('<button class="btn btn-sm bg-warning" onclick="editData(' + brand.id + ')">Edit</button><button class="btn btn-sm bg-danger" onclick="hapusData(' + brand.id + ')">Hapus</button>'));
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $(document).on('click', '#btnAddBrand', function(e) {
        var form = $('#formAddBrand')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/add_brand') ?>',
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

    function hapusData(brand_id) {
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: "<?php echo base_url('admin/delete_brand'); ?>",
                method: "POST",
                data: {
                    brand_id: brand_id
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

    function editData(brand_id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_brand_id'); ?>",
            method: "POST",
            data: {
                brand_id: brand_id
            },
            dataType: "json",
            success: function(response) {
                var brand = response.brand;
                console.log(brand)
                // Isi nilai-nilai input form dengan data produk yang diambil
                $('#editBrandModal #editBrandID').val(brand.id);
                $('#editBrandModal #editName').val(brand.name);

                // Tampilkan modal edit produk
                $('#editBrandModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $(document).on('click', '#btnUpdateBrand', function(e) {
        var form = $('#formEditBrand')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/update_brand') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('#editBrandModal').modal('hide');
                getData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
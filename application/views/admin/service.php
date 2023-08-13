<div class="container p-5">
    <div class="row">
        <div class="col-6 pl-5">
            <h4>Service</h4>
        </div>
        <div class="col-6 pr-5 text-right">

            <a href="<?= base_url() ?>admin/cetak_service" target="_BLANK"><button type="button" class="btn btn-default"><i class="fa fa-print"></i></button></a>

        </div>
        <div class="col-md-12 p-5">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" href="#tambahServiceModal">
                Add Service
            </button>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cust</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Detail</th>
                        <th>Note</th>
                        <th>Status</th>
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
<!-- Edit Product Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5" style="height: 300px !important;">
                <form id="formEditService" enctype="multipart/form-data">
                    <input type="hidden" name="service_id" id="editServiceID">
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <br>
                        <select name="status" id="editStatus" class="form-control" required="required">
                            <option value="Mulai Pembenahan">Mulai Pembenahan</option>
                            <option value="Service Selesai">Service Selesai</option>
                            <option value="Barang Telah Diambil">Barang Telah Diambil</option>
                        </select>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateService">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="tambahServiceModal" tabindex="-1" aria-labelledby="tambahServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahServiceModalLabel">Service Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5" style="height: 100% !important;">
                <form id="formTambahService" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>User</label>
                        <br>
                        <select class="form-control" id="user" name="user">
                            <?php foreach ($user as $key => $value) {
                                if ($value['category'] == 'user') { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <br>
                        <br>
                        <label>Brand</label>
                        <br>
                        <select class="form-control" id="brand" name="brand">
                            <?php foreach ($brand as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <br>
                        <br>
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <textarea name="name" id="name" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnAddService">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Spare Part -->
<div class="modal fade" id="editSparePart" tabindex="-1" aria-labelledby="editSparePartLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSparePartLabel">Spare Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5" style="height: 100% !important;" id="isiBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            url: "<?php echo base_url('admin/get_services'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var data = response;
                var tableBody = $('#brandTable');
                var a = 1
                $.each(data, function(index, value) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(value.user_name));
                    row.append($('<td>').text(value.brand_name));
                    row.append($('<td>').text(value.type));
                    row.append($('<td>').text(value.name));
                    row.append($('<td>').text(value.note));
                    row.append($('<td>').text(value.status));
                    row.append($('<td>').html('<button class="btn btn-sm bg-warning" onclick="editData(' + value.id + ')">Ubah Status</button><button class="btn btn-sm bg-danger" onclick="sparePart(' + value.id + ')">Spare Part</button>'));
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function editData(service_id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_service_by_id'); ?>",
            method: "POST",
            data: {
                service_id: service_id
            },
            dataType: "json",
            success: function(response) {
                var brand = response.service;
                $('#editServiceModal #editServiceID').val(brand.id);
                $('#editServiceModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function sparePart(id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_spare_part_service_id'); ?>",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#editSparePart').modal('show');
                var data = response;
                var html = ''
                html += '<div class="row">'
                html += '<div class="col-12">'

                html += '<table class="table table-bordered table-hover">'
                html += '<thead>'
                html += '<tr>'
                html += '<th>#</th>'
                html += '<th>Nama</th>'
                html += '<th>QTY</th>'
                html += '<th>Harga</th>'
                html += '<th>Action</th>'
                html += '</tr>'
                html += '</thead>'
                html += '<tbody id="ListSP">'
                html += '</tbody>'
                html += '</table>'

                html += '</div>'
                html += '</div>'
                html += '<br>'
                html += '<p class="mb-3"><b>Tambah Spare Part</b></p>'
                html += '<form id="formTambahSP" enctype="multipart/form-data">'
                html += '<input type="hidden" name="service_id" id="sparePartId" value="' + id + '">'
                html += '<div class="form-group">'
                html += '<label for="spare_part_id">Spare Part</label>'
                html += '<select name="spare_part_id" id="spare_part_id" class="form-control" required="required">'
                data.listPart.forEach(e => {
                    html += '<option value="' + e.id + '">' + e.nama_spare_part + '</option>'
                });
                html += '</select>'
                html += '</div>'
                html += '<div class="form-group">'
                html += '<label for="qty">QTY</label>'
                html += '<input type="number" class="form-control" id="qty" name="qty">'
                html += '</div>'
                html += '<button type="button" class="btn btn-primary" id="btnTambahSP">Tambah</button>'
                html += '</form>'
                $('#isiBody').html(html)
                listSP(data.service, id)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function listSP(data, service_id) {
        var html = ''
        var a = 1
        data.forEach(e => {
            html += '<tr>'
            html += '<td>' + a++ + '</td>'
            html += '<td>' + e.nama_spare_part + '</td>'
            html += '<td>' + e.qty + '</td>'
            html += '<td>' + e.biaya + '</td>'
            html += '<td><button class="btn btn-sm bg-danger" onclick="hapusDataSP(' + e.id + ',' + service_id + ')"><i class="fa fa-trash"></i></button></td>'
            html += '</tr>'
        });
        $('#ListSP').html(html)
    }
    $(document).on('click', '#btnUpdateService', function(e) {
        var form = $('#formEditService')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/update_service') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('#editServiceModal').modal('hide');
                getData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
    $(document).on('click', '#btnAddService', function(e) {
        var form = $('#formTambahService')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/add_service') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('#tambahServiceModal').modal('hide');
                getData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
    $(document).on('click', '#btnTambahSP', function(e) {
        var form = $('#formTambahSP')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/add_spare_part_service') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                listSP(JSON.parse(response).data)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    function hapusDataSP(id, service_id) {
        if (confirm('Are you sure you want to delete this Spare Part?')) {
            $.ajax({
                url: "<?php echo base_url('admin/delete_spare_part_service'); ?>",
                method: "POST",
                data: {
                    id: id,
                    service_id: service_id,
                },
                dataType: "json",
                success: function(response) {
                    alert(response.message);
                    listSP(response.data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }
</script>
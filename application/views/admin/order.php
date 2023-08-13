<div class="container p-5">
    <div class="row">
        <div class="col-6 pl-5">
            <h4>Customer Orders</h4>
        </div>
        <div class="col-6 pr-5 text-right">

            <a href="<?= base_url() ?>admin/cetak_order" target="_BLANK"><button type="button" class="btn btn-default"><i class="fa fa-print"></i></button></a>

        </div>
        <div class="col-md-12 p-5">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama User</th>
                        <th>Kode Pembelian</th>
                        <th>Tipe Pembayaran</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                    <td colspan="9" class="text-center">Data Not Found</td>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5" style="height: 300px !important;">
                <form id="formEditOrder" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editServiceID">
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <br>
                        <select name="status" id="editStatus" class="form-control" required="required">
                            <option value="Sedang Dikemas">Sedang Dikemas</option>
                            <option value="Dikirim">Dikirim</option>
                            <option value="Barang Diterima">Barang Diterima</option>
                        </select>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdateOrder">Update</button>
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
        $('#dataTable').html('')
        $.ajax({
            url: "<?php echo base_url('admin/get_order'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var data = response;
                var tableBody = $('#dataTable');
                var a = 1
                $.each(data, function(index, value) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(value.tgl_pembelian));
                    row.append($('<td>').text(value.name));
                    row.append($('<td>').text(value.kode_pembelian));
                    row.append($('<td>').text(value.tipe_pembayaran));
                    var bukti = ''
                    if (value.tipe_pembayaran != 'COD') {
                        bukti = '<a href="<?= base_url() ?>upload/bukti/' + value.bukti_pembayaran + '" target="_blank">Lihat Bukti</a>'
                    }
                    row.append($('<td>').html(bukti));
                    row.append($('<td>').text(value.status));
                    var html = ''
                    value.detail.forEach(e => {
                        html += '<div class="row">'
                        html += '<div class="col-10">'
                        html += e.nama_produk
                        html += '<br>'
                        html += '<small class="text-primary">' + e.price.toLocaleString() + '</small>'
                        html += '</div>'
                        html += '<div class="col-2">'
                        html += e.count + ' x'
                        html += '</div>'
                        html += '</div>'
                    });
                    row.append($('<td>').html(html));
                    row.append($('<td>').html('<button class="btn btn-sm bg-warning" onclick="editData(' + value.id + ')">Ubah Status</button>'));
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function editData(id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_order_by_id'); ?>",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                var order = response.order;
                $('#editOrderModal #editServiceID').val(order.id);
                $('#editOrderModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $(document).on('click', '#btnUpdateOrder', function(e) {
        var form = $('#formEditOrder')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/update_order') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('#editOrderModal').modal('hide');
                getData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
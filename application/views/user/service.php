<div class="container p-5">
    <div class="row">
        <div class="col-md-12 pl-5">
            <h4>Service</h4>
        </div>
        <div class="col-md-12 p-5">
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
                        <th>Spare Part</th>
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
            url: "<?php echo base_url('home/get_services'); ?>",
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
                    row.append($('<td>').html('<button class="btn btn-sm bg-danger" onclick="sparePart(' + value.id + ')">Spare Part</button>'));
                    a++
                    tableBody.append(row);
                });
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
                html += '</tr>'
                html += '</thead>'
                html += '<tbody id="ListSP">'
                html += '</tbody>'
                html += '</table>'

                html += '</div>'
                html += '</div>'
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
        var total = 0
        data.forEach(e => {
            html += '<tr>'
            html += '<td>' + a++ + '</td>'
            html += '<td>' + e.nama_spare_part + '</td>'
            html += '<td>' + e.qty + '</td>'
            html += '<td>' + e.biaya + '</td>'
            html += '</tr>'
            total = parseInt(total) + parseInt(e.biaya)
        });
        html += '<tr>'
        html += '<td colspan="3">Total Biaya</td>'
        html += '<td>' + total + '</td>'
        html += '</tr>'
        $('#ListSP').html(html)
    }

    function batalService(service_id) {
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
</script>
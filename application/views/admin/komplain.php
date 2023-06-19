<div class="container p-5">
    <div class="row">
        <div class="col-md-12 pl-5">
            <h4>Complaint</h4>
        </div>
        <div class="col-md-12 p-5">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cust</th>
                        <th>Title</th>
                        <th>Detail</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="komplainTable">
                    <tr>
                        <td colspan="7" class="text-center">Data Not Found</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editKomplainModal" tabindex="-1" aria-labelledby="editKomplainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKomplainModalLabel">Balas Komplain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5" style="height: 300px !important;">
                <form id="formKomplain" enctype="multipart/form-data">
                    <input type="hidden" name="komplain_id" id="editKomplainID">
                    <div class="form-group">
                        <label for="balasan">Balasan</label>
                        <textarea name="balasan" id="balasan" class="form-control" rows="3" required="required"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnBalasan">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Lihat Balasan -->
<div class="modal fade" id="lihatBalasan" tabindex="-1" aria-labelledby="lihatBalasanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatBalasanLabel">Balasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Balasan</th>
                        </tr>
                    </thead>
                    <tbody id="listFormBalasan">
                    </tbody>
                </table>

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
        $('#komplainTable').html('')
        $.ajax({
            url: "<?php echo base_url('admin/get_komplain'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var data = response;
                var tableBody = $('#komplainTable');
                var a = 1
                $.each(data, function(index, value) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(value.user_name));
                    row.append($('<td>').text(value.title));
                    row.append($('<td>').text(value.detail));
                    row.append($('<td>').html('<a href="#" class="text-primary" onclick="lihatBalasan(' + value.id + ')">' + value.total_balasan + ' Reply</a>'));
                    row.append($('<td>').html('<button class="btn btn-sm bg-warning" onclick="editData(' + value.id + ')">Balas</button>'));
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function editData(komplain_id) {
        $.ajax({
            url: "<?php echo base_url('admin/get_komplain_by_id'); ?>",
            method: "POST",
            data: {
                komplain_id: komplain_id
            },
            dataType: "json",
            success: function(response) {
                var brand = response.komplain;
                $('#editKomplainModal #editKomplainID').val(brand.id);
                $('#editKomplainModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $(document).on('click', '#btnBalasan', function(e) {
        var form = $('#formKomplain')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '<?= base_url('admin/add_komplain') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(JSON.parse(response).message);
                $('#editKomplainModal').modal('hide');
                getData();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    function lihatBalasan(komplain_id) {
        $('#listFormBalasan').html('')
        $.ajax({
            url: "<?php echo base_url('admin/get_balasan_id'); ?>",
            method: "POST",
            dataType: "json",
            data: {
                komplain_id: komplain_id
            },
            success: function(response) {
                $('#lihatBalasan').modal('show');
                var data = response;
                var tableBody = $('#listFormBalasan');
                var a = 1
                console.log(data)
                $.each(data, function(index, value) {
                    var row = $('<tr>');
                    row.append($('<td>').text(a));
                    row.append($('<td>').text(value.balasan));
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
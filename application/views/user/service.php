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
                    a++
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
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
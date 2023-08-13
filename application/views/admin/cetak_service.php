<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Service</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="m-0">Laporan Service</h3>
            <h3 class="m-0">Toko Mandiri Service</h3>
        </div>
        <div class="col-12">
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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                        a++
                        tableBody.append(row);
                    });
                    window.print();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
</body>

</html>
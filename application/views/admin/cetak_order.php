<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Order</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body style="padding:90px;">
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="m-0">Laporan Penjualan</h3>
            <h3 class="m-0">Toko Mandiri Service</h3>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-hover table-sm" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama User</th>
                        <th>Kode Pembelian</th>
                        <th>Tipe Pembayaran</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Ongkir</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                    <td colspan="9" class="text-center">Data Not Found</td>
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
                        row.append($('<td>').text(value.status));
                        var html = ''
                        var total = 0
                        value.detail.forEach(e => {
                            total += parseInt(e.price)
                            html += '(' + e.count + ') ' + e.nama_produk
                        });
                        total += parseInt(value.ongkir)
                        row.append($('<td>').html(html));
                        row.append($('<td>').text(value.ongkir.toLocaleString()));
                        row.append($('<td>').text(total.toLocaleString()));
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
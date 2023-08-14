<div class="container p-5">
    <div class="row">
        <div class="col-md-12 pl-5">
            <h4>My Order</h4>
        </div>
        <div class="col-md-12 p-5">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Pembelian</th>
                        <th>Tipe Pembayaran</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Ongkir</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1;
                    foreach ($order as $key => $value) { ?>
                        <tr>
                            <td><?= $a++ ?></td>
                            <td><?= $value['tgl_pembelian'] ?></td>
                            <td><?= $value['kode_pembelian'] ?></td>
                            <td><?= $value['tipe_pembayaran'] ?></td>
                            <td><?= $value['status'] ?></td>
                            <td>
                                <?php
                                $total = 0;
                                foreach ($value['detail'] as $k => $v) {
                                    $total = $total + $v['price'];
                                ?>
                                    <div class="row">
                                        <div class="col-10">
                                            <?= $v['nama_produk'] ?>
                                            <br>
                                            <small class="text-primary"><?= number_format($v['price']) ?></small>
                                        </div>
                                        <div class="col-2">
                                            <?= $v['count'] ?> x
                                        </div>
                                    </div>
                                <?php }
                                $total = $total + $value['ongkir'];
                                ?>
                            </td>
                            <td><?= number_format($value['ongkir']) ?></td>
                            <td><?= number_format($total) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
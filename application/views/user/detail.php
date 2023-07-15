<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Detail Produk</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($products as $key => $value) { ?>
                <div class="col text-right">
                    <img class="default-img" src="<?= base_url() ?>upload/product/<?= $value['image'] ?>" alt="#" style="width:250px;height:250px;object-fit:cover">
                </div>
                <div class="col">
                    <b><?= $value['brand_name'] ?></b>
                    <h3><a href="<?= base_url() ?>home/detail/<?= $value['id'] ?>"><?= $value['name'] ?></a></h3>
                    <div class="product-price mb-5">
                        <span>Rp. <?= number_format($value['harga']) ?></span>
                    </div>

                    <b class="mt-5">Stok : <?= $value['stok'] ?></b>
                    <br>
                    <button type="button" class="btn btn-default btn-primary" onclick="addCart(<?= $value['id'] ?>)">Add to cart</button>

                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addCart(id_produk) {
        $.ajax({
            url: "<?php echo base_url('home/add_cart'); ?>",
            method: "POST",
            data: {
                id_produk: id_produk
            },
            dataType: "json",
            success: function(response) {
                alert(response.message);
                getDataCart();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
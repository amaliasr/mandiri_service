<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-form">
                    <h2>Make Your Checkout Here</h2>
                    <p>Please check your data in order to checkout more quickly</p>
                    <!-- Form -->
                    <form class="form" id="checkoutForm">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Your Name<span>*</span></label>
                                    <input type="text" name="name" id="name" placeholder="" required="required" value="<?= $this->session->userdata('name') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email Address<span>*</span></label>
                                    <input type="email" name="email" id="email" placeholder="" required="required" value="<?= $this->session->userdata('email') ?>" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Phone Number<span>*</span></label>
                                    <input type="number" name="phone" id="phone" placeholder="" required="required" value="<?= $this->session->userdata('phone') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat<span>*</span></label>
                                    <input type="text" name="alamat" id="alamat" placeholder="" required="required" value="<?= $this->session->userdata('alamat') ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Kota<span>*</span></label>
                                    <select name="city" id="city" class="form-control" required="required" onchange="getOngkir()">
                                        <?php foreach ($city as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>" data-ongkir="<?= $value['ongkir'] ?>"><?= $value['nama'] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="order-details">
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>CART TOTALS</h2>
                        <div class="content">
                            <div class="row p-4">
                                <?php $total = 0;
                                foreach ($cart[0]['keranjang'] as $key => $value) { ?>
                                    <div class="col-6"><?= $value['nama_produk'] ?><br>
                                        <span class="small text-grey"><?= $value['count'] ?> x</span>
                                    </div>
                                    <div class="col-6 text-right"><?= number_format($value['total_harga']) ?></div>
                                <?php $total = $total + $value['total_harga'];
                                } ?>
                            </div>
                            <ul>
                                <li class="last"><b>Biaya Ongkir</b><span><b id="biayaOngkir"></b></span></li>
                                <li class="last"><b>Total</b><span><b id="grandTotal"><?= number_format($total) ?></b></span></li>
                            </ul>
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>Payments</h2>
                        <div class="content">
                            <div class="row pl-4 mt-4">
                                <div class="col-12 ml-4">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="payment1" value="1" onclick="payment(1)">
                                        <label class="form-check-label" for="payment1">
                                            Transfer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="payment2" value="2" onclick="payment(2)">
                                        <label class="form-check-label" for="payment2">
                                            Cash On Delivery
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="checkbox">
                                <label class="checkbox-inline" for="1"><input name="payment" id="1" value="1" type="radio" onclick="payment(1)"> Transfer</label>
                                <label class="checkbox-inline" for="2"><input name="payment" id="2" value="2" type="radio" onclick="payment(2)"> Cash On Delivery</label>
                            </div> -->
                        </div>
                    </div>
                    <div class="single-widget" id="showTransfer" hidden>
                        <h2>Kirim Bukti Transfer</h2>
                        <div class="content">
                            <div class="checkbox">
                                <input type="file" class="form-control-file mb-2" id="image" name="image" accept="image/*" required>
                            </div>
                        </div>
                    </div>


                    <!--/ End Order Widget -->
                    <!-- Payment Method Widget -->
                    <!--/ End Payment Method Widget -->
                    <!-- Button Widget -->
                    <div class="single-widget get-button">
                        <div class="content">
                            <div class="button">
                                <a style="cursor: pointer;" class="btn" onclick="submitForm()">proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                    <!--/ End Button Widget -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Checkout -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var total = '<?= $total ?>'
    $(document).ready(function() {
        getOngkir()
    });

    function getOngkir() {
        var data = $('#city').find(':selected').data('ongkir')
        $('#biayaOngkir').html(data.toLocaleString())
        var grandTotal = parseInt(data) + parseInt(total)
        $('#grandTotal').html(grandTotal.toLocaleString())
    }

    function payment(code) {
        // if (code == 1) {
        if ($('[name="payment"][value="1"]').is(':checked')) {
            $('#showTransfer').removeAttr('hidden');
        } else {
            $('#showTransfer').attr('hidden', true);
        }
        // }
    }

    function submitForm() {
        if (confirm('Apakah Anda ingin langsung checkout?')) {
            // Melakukan proses checkout
            checkout();
        }
    }

    function checkout() {
        var formData = new FormData(document.getElementById('checkoutForm'));
        var image = document.getElementById('image').files[0];
        formData.append('image', image);

        // Mengambil nilai checkbox
        var paymentCheckbox = document.getElementsByName('payment');
        var paymentValues = [];
        for (var i = 0; i < paymentCheckbox.length; i++) {
            if (paymentCheckbox[i].checked) {
                paymentValues.push(paymentCheckbox[i].value);
            }
        }
        formData.append('payment', paymentValues);

        $.ajax({
            url: "<?php echo base_url('home/processCheckout'); ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = "<?= base_url('home/order'); ?>";
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
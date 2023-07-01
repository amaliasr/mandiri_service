<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <?php if (is_login()) { ?>
                                <li><i class="ti-power-off"></i><a href="<?= base_url() ?>logout">Logout</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html"><img src="<?= base_url() ?>assets/images/logo.png" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <!-- <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option selected="selected">All Category</option>
                                <option>watch</option>
                                <option>mobile</option>
                                <option>kid’s item</option>
                            </select>
                            <form>
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <?php if (is_login()) { ?>
                        <?php if (is_user()) { ?>
                            <div class="right-bar">
                                <!-- Search Form -->
                                <div class="sinlge-bar">
                                    <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="sinlge-bar">
                                    <a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="sinlge-bar shopping">
                                    <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count jumlahCart">0</span></a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span><span class="jumlahCart"></span> Items</span>
                                            <a href="#">View Cart</a>
                                        </div>
                                        <ul class="shopping-list" id="shoppingList">

                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount" id="totalCart"></span>
                                            </div>
                                            <a href="<?= base_url() ?>home/checkout" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                    <!--/ End Shopping Item -->
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <?php if (is_login()) { ?>
        <div class="header-inner">
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <!-- <div class="col-lg-3">
                            <div class="all-category">
                                <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
                                <ul class="main-category">
                                    <li><a href="#">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="sub-category">
                                            <li><a href="#">accessories</a></li>
                                            <li><a href="#">best selling</a></li>
                                            <li><a href="#">top 100 offer</a></li>
                                            <li><a href="#">sunglass</a></li>
                                            <li><a href="#">watch</a></li>
                                            <li><a href="#">man’s product</a></li>
                                            <li><a href="#">ladies</a></li>
                                            <li><a href="#">westrn dress</a></li>
                                            <li><a href="#">denim </a></li>
                                        </ul>
                                    </li>
                                    <li class="main-mega"><a href="#">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="mega-menu">
                                            <li class="single-menu">
                                                <a href="#" class="title-link">Shop Kid's</a>
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/225x155" alt="#">
                                                </div>
                                                <div class="inner-link">
                                                    <a href="#">Kids Toys</a>
                                                    <a href="#">Kids Travel Car</a>
                                                    <a href="#">Kids Color Shape</a>
                                                    <a href="#">Kids Tent</a>
                                                </div>
                                            </li>
                                            <li class="single-menu">
                                                <a href="#" class="title-link">Shop Men's</a>
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/225x155" alt="#">
                                                </div>
                                                <div class="inner-link">
                                                    <a href="#">Watch</a>
                                                    <a href="#">T-shirt</a>
                                                    <a href="#">Hoodies</a>
                                                    <a href="#">Formal Pant</a>
                                                </div>
                                            </li>
                                            <li class="single-menu">
                                                <a href="#" class="title-link">Shop Women's</a>
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/225x155" alt="#">
                                                </div>
                                                <div class="inner-link">
                                                    <a href="#">Ladies Shirt</a>
                                                    <a href="#">Ladies Frog</a>
                                                    <a href="#">Ladies Sun Glass</a>
                                                    <a href="#">Ladies Watch</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#">accessories</a></li>
                                    <li><a href="#">top 100 offer</a></li>
                                    <li><a href="#">sunglass</a></li>
                                    <li><a href="#">watch</a></li>
                                    <li><a href="#">man’s product</a></li>
                                    <li><a href="#">ladies</a></li>
                                    <li><a href="#">westrn dress</a></li>
                                    <li><a href="#">denim </a></li>
                                </ul>
                            </div>
                        </div> -->
                        <div class="col-lg-9 col-12">
                            <div class="menu-area">
                                <nav class="navbar navbar-expand-lg">
                                    <div class="navbar-collapse">
                                        <div class="nav-inner">
                                            <ul class="nav main-menu menu navbar-nav">
                                                <?php if (is_user()) { ?>
                                                    <li><a href="<?= base_url() ?>home">Home</a></li>
                                                    <li><a href="<?= base_url() ?>home/service">Service</a></li>
                                                    <li><a href="<?= base_url() ?>home/order">Orders</a></li>
                                                    <li><a href="<?= base_url() ?>home/contact">Contact Us</a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?= base_url() ?>admin">Home</a></li>
                                                    <li><a href="<?= base_url() ?>admin/brand">Brand</a></li>
                                                    <li><a href="<?= base_url() ?>admin/product">Product</a></li>
                                                    <li><a href="<?= base_url() ?>admin/service">Service</a></li>
                                                    <li><a href="<?= base_url() ?>admin/order">Orders</a></li>
                                                    <li><a href="<?= base_url() ?>admin/complaint">Complaint</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--/ End Header Inner -->
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        getDataCart()
    });


    function getDataCart() {
        var jumlah = 0
        $('#shoppingList').html('')
        $.ajax({
            url: "<?php echo base_url('home/getCartItems'); ?>",
            method: "GET",
            dataType: "json",
            success: function(response) {
                var html = ''
                var total = 0
                if (response[0] != undefined) {
                    var data = response[0].keranjang
                    data.forEach(e => {
                        var img = '<?= base_url() ?>upload/product/' + e.image
                        html += '<li>'
                        html += '<a onclick="removeCart(' + e.id_produk + ')" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>'
                        html += '<a class="cart-img" href="#"><img src="' + img + '" alt="#"></a>'
                        html += '<h4><a href="#">' + e.nama_produk + '</a></h4>'
                        html += '<p class="quantity">' + e.count + 'x - <span class="amount">' + e.total_harga.toLocaleString() + '</span></p>'
                        html += '</li>'
                        $('#shoppingList').html(html)
                        total = total + parseInt(e.total_harga)
                    });
                    jumlah = data.length
                }
                $('#totalCart').html(total.toLocaleString())
                $('.jumlahCart').html(jumlah)
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function removeCart(id_produk) {
        $.ajax({
            url: "<?php echo base_url('home/remove_cart'); ?>",
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
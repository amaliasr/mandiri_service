<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                    <button class="btn btn-primary" id="btnLogin" onclick="login()">Login</button>
                    <br>
                    <a href="<?= base_url() ?>auth/register">Registrasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // $(document).on('click', '#btnLogin', function(e) {

    // });
    function login() {
        var email = $('#inputEmail').val();
        var password = $('#inputPassword').val();
        var category = '<?= $this->session->userdata('category') ?>'
        $.ajax({
            url: '<?= base_url() ?>auth/doLogin',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response === 'success') {
                    alert('Login berhasil');
                    if (category == 'admin') {
                        window.location.href = '<?= base_url() ?>admin'
                    } else {
                        window.location.href = '<?= base_url() ?>home'
                    }
                } else {
                    alert('Login gagal');
                }
            }
        });
    }
</script>
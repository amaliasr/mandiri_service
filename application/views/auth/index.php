<div class="container m-5">
    <div class="row m-5">
        <form>
            <div class="form-group">
                <label for="imputEmail">Email address</label>
                <input type="email" class="form-control" id="imputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <button class="btn btn-primary" id="btnLogin">Login</button>

        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#btnLogin').click(function() {
            var email = $('#inputEmail').val();
            var password = $('#inputPassword').val();

            $.ajax({
                url: '<?= base_url() ?>Auth/doLogin',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    if (response === 'success') {
                        alert('Login berhasil');
                    } else {
                        alert('Login gagal');
                    }
                }
            });
        });
    });
</script>
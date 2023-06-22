<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h5 class="mb-4">Registrasi Akun</h5>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputNama">Nama</label>
                        <input type="text" class="form-control" id="inputNama" placeholder="Enter Nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat Rumah</label>
                        <input type="text" class="form-control" id="inputAlamat" placeholder="Alamat Rumah" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="inputEmailBaru">Email</label>
                        <input type="email" class="form-control" id="inputEmailBaru" placeholder="Enter email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordBaru">Password</label>
                        <input type="password" class="form-control" id="inputPasswordBaru" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmPassword">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Password" autocomplete="off">
                    </div>
                    <button class="btn btn-primary" id="btnDaftar" onclick="daftar()">Daftar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // $(document).on('click', '#btnLogin', function(e) {

    // });
    function daftar() {
        var nama = $('#inputNama').val();
        var alamat = $('#inputAlamat').val();
        var email = $('#inputEmailBaru').val();
        var password = $('#inputPasswordBaru').val();
        var confirmPassword = $('#inputConfirmPassword').val();

        $.ajax({
            url: '<?= base_url() ?>auth/doRegist',
            type: 'POST',
            data: {
                nama: nama,
                alamat: alamat,
                email: email,
                password: password,
                confirmPassword: confirmPassword,
            },
            success: function(response) {
                if (response === 'success') {
                    alert('Pendaftaran berhasil');
                    window.location.href = '<?= base_url() ?>home'
                } else {
                    alert('Pendaftaran gagal');
                }
            }
        });
    }
</script>
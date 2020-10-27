<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
</head>
<body>
<div class="container" style="margin-top: 50px;margin-bottom: 50px">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="/"><img style="width:100%;" src="https://mamikos.com/assets/logo/svg/logo_mamikos_green.svg"></a>
                    <hr>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_lengkap" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="type_user">
                            <option value="1">Owner</option>
                            <option value="2">Regular User</option>
                            <option value="3">Premium User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password">
                    </div>
                    <button class="btn btn-block btn-success" id="btnRegister">REGISTER</button>
                </div>
            </div>
            <div class="text-center" style="margin-top: 15px">
                Sudah punya akun? <a href="/login">Silahkan Login</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $("#btnRegister").click(function() {
        var nama_lengkap = $("#nama_lengkap").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();
        var type_user = $("#type_user").val();
        var token = $("meta[name='csrf-token']").attr("content");

        if (nama_lengkap.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Nama Lengkap Wajib Diisi !'
            });
        } else if (email.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Alamat Email Wajib Diisi !'
            });
        } else if (type_user == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Tipe User Wajib Diisi !'
            });
        } else if (password.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi !'
            });
        } else if (password !== password_confirmation) {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Password Konfirmasi tidak sama !'
            });
        } else {
            $.ajax({
                url: "{{ route('register.store') }}",
                type: "POST",
                cache: false,
                data: {
                    "nama_lengkap": nama_lengkap,
                    "email": email,
                    "password": password,
                    "type_user": type_user,
                    "_token": token
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            type: 'success',
                            title: 'Register Berhasil!',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = "{{ route('dashboard.index') }}";
                        });
                        $("#nama_lengkap").val('');
                        $("#email").val('');
                        $("#password").val('');
                        $("#password_confirmation").val('');
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Register Gagal!',
                            text: 'silahkan coba lagi!'
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });
                }
            })
        }
    });
});
</script>
</body>
</html>
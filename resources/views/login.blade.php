<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
</head>
<body>
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="/"><img style="width:100%;" src="https://mamikos.com/assets/logo/svg/logo_mamikos_green.svg"></a>
                    <hr>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button class="btn btn-block btn-success" id="btnLogin">LOGIN</button>
                </div>
            </div>
            <div class="text-center" style="margin-top: 15px">
                Belum punya akun? <a href="/register">Silahkan Register</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $("#btnLogin").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        var token = $("meta[name='csrf-token']").attr("content");

        if (email.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Alamat Email Wajib Diisi !'
            });
        } else if (password.length == "") {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi !'
            });
        } else {
            $.ajax({
                url: "{{ route('login.check_login') }}",
                type: "POST",
                dataType: "JSON",
                cache: false,
                data: {
                    "email": email,
                    "password": password,
                    "_token": token
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            type: 'success',
                            title: 'Login Berhasil!',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        .then(function() {
                            window.location.href = "{{ route('dashboard.index') }}";
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Login Gagal!',
                            text: 'silahkan coba lagi!'
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'Login failed!'
                    });
                }
            });
        }
    });
});
</script>
</body>
</html>
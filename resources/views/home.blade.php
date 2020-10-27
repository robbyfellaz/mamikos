<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mamikos</title>
</head>
<body>
    <div class="container" style="margin-top: 50px">
        @if (Auth::user())
        <input type="text" id="id_user" value="{{ Auth::user()->id }}" hidden>
        @else
        <input type="text" id="id_user" value="" hidden>
        @endif
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand" href="/"><img style="height:40px;" src="https://mamikos.com/assets/logo/svg/logo_mamikos_green.svg"></a>
            <form class="form-inline my-2 my-lg-0">
                @if (Route::has('login'))
                @auth
                <a class="navbar-brand" href="{{ route('dashboard.index') }}">Dashboard | </a>
                <a class="navbar-brand">{{ Auth::user()->name }}</a>
                @else
                <a class="navbar-brand" href="{{ route('login') }}">Login</a>
                <a class="navbar-brand" href="{{ route('register.index') }}">Register</a>
                @endauth
                @endif
            </form>
        </nav>
        <form class="form-inline" style="margin-top: 20px">
            <label class="sr-only" for="searchName"></label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="searchName" placeholder="Nama Kost">
            <label class="sr-only" for="searchLocation"></label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="searchLocation" placeholder="Lokasi">
            <label class="sr-only" for="searchHargaAwal"></label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="searchHargaAwal" placeholder="Harga Min">
            <label class="sr-only" for="searchHargaAkhir"></label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="searchHargaAkhir" placeholder="Harga Max">
            <label class="my-1 mr-2" for="sortPrice"></label>
            <select class="custom-select my-1 mr-sm-2" id="sortPrice" style="margin-top: -5px!important">
                <option value="ALL" selected>Sort by price...</option>
                <option value="ASC">Harga Terendah</option>
                <option value="DESC">Harga Tertinggi</option>
            </select>
            <button type="button" class="btn btn-primary mb-2" id="btnFilter">Cari</button>
        </form>
        <div class="row" id="show"></div>
    </div>
    <div class="modal fade" id="modalAvailableRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Available Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showRoom"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetailKost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Kost</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showDetail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script>
    listKost();
    var id_user = $('#id_user').val();

    function listKost() {
        $.ajax({
            url: "{{ route('home.listKost') }}",
            type: "POST",
            data: {
                name: $('#searchName').val(),
                location: $('#searchLocation').val(),
                harga_awal: $('#searchHargaAwal').val(),
                harga_akhir: $('#searchHargaAkhir').val(),
                sortPrice: $('#sortPrice').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response) {
                    var html = '';
                    $.each(response, function(index, item) {
                        html += '<div class="col-md-3">';
                        html += '<div class="card" style="width: 250px;">';
                        html += '<img class="card-img-top" src="' + item.image + '" alt="Card image cap">';
                        html += '<div class="card-body">';
                        html += '<h5 class="card-title">' + item.name + '</h5>';
                        html += '<p class="card-text">' + item.description + ' | ' + item.location + '</p>';
                        html += '<p class="card-text">Rp. ' + item.price + '</p>';
                        if (id_user) {
                            html += '<button data-id="' + item.id + '" onclick="availableRoom(event.target)" class="btn btn-primary btn-sm" style="margin-right:5px;">Available Room</button>';
                        }
                        html += '<button data-id="' + item.id + '" onclick="detailKost(event.target)" class="btn btn-success btn-sm" style="margin-right:5px;">Detail Kost</button>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });
                    $('#show').html(html);
                }
            }
        });
    }

    $("#btnFilter").click(function() {
        listKost();
    });

    function availableRoom(event) {
        var id = $(event).data("id");
        var id_user = $('#id_user').val();
        $.ajax({
            url: "{{ route('home.availableRoom') }}",
            type: "POST",
            data: {
                id: id,
                id_user: id_user,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var html = '';
                html += '<h4> Room tersedia: ' + response.available_room + '</h4>';
                html += '<p> *point anda dikurangi 5 point</p>';
                $('#showRoom').html(html);
                $('#modalAvailableRoom').modal('show');
            }
        });
    }

    function detailKost(event) {
        var id = $(event).data("id");
        $.ajax({
            url: "{{ route('home.detailKost') }}",
            type: "POST",
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var html = '';
                html += '<div class="card">';
                html += '<div class="card-header">';
                html += '<img style="width:100%;" src="' + response.image + '">';
                html += '</div>';
                html += '<div class="card-body">';
                html += '<h5 class="card-title">' + response.name + '</h5>';
                html += '<p class="card-text">' + response.description + '</p>';
                html += '<p class="card-text">' + response.location + '</p>';
                html += '<p class="card-text">' + response.price + '</p>';
                html += '</div>';
                html += '</div>';
                $('#showDetail').html(html);
                $('#modalDetailKost').modal('show');
            }
        });
    }
</script>
</body>
</html>
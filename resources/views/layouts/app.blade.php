<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />
    <title>Dashboard</title>
</head>
<body>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="{{ route('dashboard.index') }}" class="list-group-item" style="color: #212529;">Dashboard</a>
                    @if (Auth::user()->type_user == 1)
                    <a href="/kosts" class="list-group-item" style="color: #212529;">Manage Kost</a>
                    @endif
                    <a href="/" class="list-group-item" style="color: #212529;">Search Kost</a>
                    <a href="{{ route('dashboard.logout') }}" class="list-group-item" style="color: #212529;">Logout</a>
                </ul>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    @stack('scripts')
</body>
</html>
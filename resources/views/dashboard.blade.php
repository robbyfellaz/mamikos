@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <a href="/"><img style="height:40px;" src="https://mamikos.com/assets/logo/svg/logo_mamikos_green.svg"></a>
            <hr>
            Selamat Datang {{ Auth::user()->name }}. Points: {{ Auth::user()->credit_points }}
        </div>
    </div>
</div>
@stop
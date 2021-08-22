@extends('adminlte::page')

@section('title', 'Ruangan')

@section('content_header')
    <h1>Tambah Ruangan</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(['route' => 'ruangan.store', 'method' => 'POST', 'files' => false]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name :</strong>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Ruangan', 'required']) !!}
            </div>
            <div class="form-group">
                <strong>Lantai :</strong>
                {!! Form::number('lantai', null, ['class' => 'form-control', 'placeholder' => 'Kode Ruangan', 'required']) !!}
            </div>
            <div class="form-group">
                <strong>Gedung :</strong>
                {!! Form::select('gedung_id', $gedungs->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Pilih Gedung', 'required']) !!}
            </div>
            <div class="form-group">
                <strong>Koordinat Longitude :</strong>
                {!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => 'Koordinat Longitude', 'required']) !!}
                <span>Dapatkan koordinat longitute di Google Maps</span>
            </div>
            <div class="form-group">
                <strong>Koordinat Latitude :</strong>
                {!! Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => 'Koordinat Latitude', 'required']) !!}
                <span>Dapatkan koordinat latidude di Google Maps</span>
                <div class="d-block" id="locationanda"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" class="btn btn-success" onclick="handlePermission()">Dapatkan
                Lokasi Anda</button>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
        var y = document.getElementById("locationanda");

        function getLocationAnda() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
            } else {
                y.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function tampilPosition(position) {
            y.innerHTML = "Koordinat Lokasi Anda : ( " + position.coords.latitude + " , " + position.coords.longitude +
            " )";
        }

        function tampilError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    y.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    y.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    y.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    y.innerHTML = "An unknown error occurred."
                    break;
            }
        }

        function handlePermission() {
            navigator.permissions.query({
                name: 'geolocation'
            }).then(function(result) {
                if (result.state == 'granted') {
                    navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
                } else if (result.state == 'prompt') {
                    navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
                } else if (result.state == 'denied') {
                    navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
                }

            });
        }
    </script>
@stop

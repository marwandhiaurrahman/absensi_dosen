@extends('adminlte::page')

@section('title', 'Absensi Keluar')

@section('content_header')
<h1>Absensi Keluar</h1>
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

{!! Form::model($absensi, ['method' => 'PATCH','route' => ['absensi.update', $absensi->id],'files' => false]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tanggal Pertemuan :</strong>
            {!! Form::date('tanggal', Carbon\Carbon::now(), array('class' => 'form-control','required'))
            !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Metode :</strong>
            {!! Form::select('metode', ['Tatap Muka'=>'Tatap Muka','E-Class'=>'E-Class',], null,
            ['class' => 'form-control','required','placeholder'=>'Pilih Metode']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Metode :</strong>
            {!! Form::textarea('pembahasan', null, ['class' =>
            'form-control','required','placeholder'=>'Masukan
            Pembahasan','rows'=>'3']) !!}
            {!! Form::hidden('jadwal_id', $jadwal->id) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Koordinat Latitude Anda :</strong>
            <input type="text" name="lat_anda" class="form-control" id="lat_anda" value="" readonly
                required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Koordinat Longitude Anda :</strong>
            <input type="text" name="long_anda" class="form-control" id="long_anda" value="" readonly
                required>
        </div>
    </div>
    <div class="d-block" id="">
        <div class="col-xs-12 col-sm-12 col-md-12"> <button type="button" class="btn btn-sm btn-primary"
                onclick="handlePermission()">Dapatkan
                Lokasi Anda</button></div>
    </div>
    <div class="d-block" id="">
        {!! Form::submit('Absensi Keluar', ['class'=>'btn btn-danger']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
    function tampilPosition(position) {
    document.getElementById("lat_anda").value = position.coords.latitude;
    document.getElementById("long_anda").value = position.coords.longitude;
}
function tampilError(error) {
switch(error.code) {
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
  navigator.permissions.query({name:'geolocation'}).then(function(result) {
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

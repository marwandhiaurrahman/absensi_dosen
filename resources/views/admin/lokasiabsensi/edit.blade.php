@extends('adminlte::page')

@section('title', 'Edit Lokasi Absensi')

@section('content_header')
<h1>Edit Lokasi Absensi</h1>
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

{!! Form::model($lokasi_absensi, ['method' => 'PATCH','route' => ['lokasi-absensi.update', $lokasi_absensi],'files' => false]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nama Lokasi', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Koordinat Latitude :</strong>
            {!! Form::text('latitude', $latitude, ['class'=>'form-control', 'placeholder'=>'Masukan Koodinat Latitude',
            'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Koordinat Longitude :</strong>
            {!! Form::text('longitude', $longitude, ['class'=>'form-control', 'placeholder'=>'Masukan Koodinat Longitude',
            'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Jarak Minimal Absensi (meter) :</strong>
            {!! Form::text('jarak_min', null, ['class'=>'form-control', 'placeholder'=>'Masukan Jarak Minimal Absensi
            (Meter)', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

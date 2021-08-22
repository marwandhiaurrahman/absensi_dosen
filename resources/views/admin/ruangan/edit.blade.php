@extends('adminlte::page')

@section('title', 'Edit Ruangan')

@section('content_header')
<h1>Edit Ruangan</h1>
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

{!! Form::model($ruangan, ['method' => 'PATCH','route' => ['ruangan.update', $ruangan->id],'files' => false]) !!}
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
            {!! Form::text('longitude', $ruangan->location->getLng(), ['class' => 'form-control', 'placeholder' => 'Koordinat Longitude', 'required']) !!}
            <span>Dapatkan koordinat longitute di Google Maps</span>
        </div>
        <div class="form-group">
            <strong>Koordinat Latitude :</strong>
            {!! Form::text('latitude', $ruangan->location->getLat(), ['class' => 'form-control', 'placeholder' => 'Koordinat Latitude', 'required']) !!}
            <span>Dapatkan koordinat latidude di Google Maps</span>
            <div class="d-block" id="locationanda"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

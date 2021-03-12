@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content_header')
<h1>Edit Fakultas</h1>
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

{!! Form::model($kela, ['method' => 'PATCH','route' => ['kelas.update', $kela->id],'files' => false]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kode:</strong>
            {!! Form::text('kode', null, ['class'=>'form-control', 'placeholder'=>'Kode Fakultas', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nama Fakultas', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('tahun', null, ['class'=>'form-control', 'placeholder'=>'Nama Fakultas', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Program Studi:</strong>
            {!! Form::select('prodi_id', $prodi->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Pilih Fakultas', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

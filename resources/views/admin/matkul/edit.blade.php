@extends('adminlte::page')

@section('title', 'Edit Matkul')

@section('content_header')
<h1>Edit Matkul</h1>
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

{!! Form::model($matkul, ['method' => 'PATCH','route' => ['matkul.update', $matkul->id],'files' => false]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name :</strong>
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nama Matkul', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kode :</strong>
            {!! Form::text('kode', null, ['class'=>'form-control', 'placeholder'=>'Kode Matkul', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Dosen :</strong>
            {!! Form::select('user_id', $users->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Pilih Gedung', 'required']) !!}
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

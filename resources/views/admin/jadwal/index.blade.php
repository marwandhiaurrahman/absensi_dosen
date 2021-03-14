@extends('adminlte::page')

@section('title', 'Jadwal Kuliah')

@section('content_header')
<h1>Jadwal Kuliah</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Jadwal Kuliah</h3>
                    <div class="card-tools">
                        {{-- @can('jadwal-create') --}}
                        <a class="btn btn-sm btn-success" href="{{ route('jadwal.create') }}">+ Tambah Jadwal Kuliah</a>
                        {{-- @endcan --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="DataTable" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Senin</th>
                                            <th>Selasa</th>
                                            <th>Rabu</th>
                                            <th>Kamis</th>
                                            <th>Jumat</th>
                                            <th>Sabtu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwals as $jadwal)
                                        <tr>
                                            <td>{{$jadwal->jam}}</td>
                                            <td>WEB1</td>
                                            <td>Selasa</td>
                                            <td>Rabu</td>
                                            <td>Kamis</td>
                                            <td>Jumat</td>
                                            <td>Sabtu</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop

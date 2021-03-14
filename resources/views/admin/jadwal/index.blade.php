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
                                <table id="DataTable"
                                    class="table text-xs table-bordered table-striped dataTable dtr-inline" role="grid"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th width="60px">Waktu</th>
                                            <th>Senin</th>
                                            <th>Selasa</th>
                                            <th>Rabu</th>
                                            <th>Kamis</th>
                                            <th>Jumat</th>
                                            <th>Sabtu</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($jamkuls as $jamkul)
                                        <tr>
                                            <td>{{$jamkul->masuk}} sd.<br>{{$jamkul->keluar}} {{$jamkul->sks}} SKS</td>
                                            <td>
                                                @foreach ($jadwals as $jadwal)
                                                @if ($jadwal->hari == 1 && $jadwal->jam == $jamkul->id)
                                                <button type="button" class="btn btn-xs btn-danger text-xs m-1"
                                                    data-toggle="modal" data-target="#modal-pemasukan-tunai">
                                                    {{$jadwal->matkul->name}}
                                                </button>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($jadwals as $jadwal)
                                                @if ($jadwal->hari == 2 && $jadwal->jam == $jamkul->id)
                                                <button type="button" class="btn btn-xs btn-danger text-xs m-1"
                                                    data-toggle="modal" data-target="#modal-pemasukan-tunai">
                                                    {{$jadwal->matkul->name}}
                                                </button>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($jadwals as $jadwal)
                                                @if ($jadwal->hari == 3 && $jadwal->jam == $jamkul->id)
                                                <button type="button" class="btn btn-xs btn-danger text-xs m-1"
                                                    data-toggle="modal" data-target="#modal-pemasukan-tunai">
                                                    {{$jadwal->matkul->name}}
                                                </button>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($jadwals as $jadwal)
                                                @if ($jadwal->hari == 4 && $jadwal->jam == $jamkul->id)
                                                <button type="button" class="btn btn-xs btn-danger text-xs m-1"
                                                    data-toggle="modal" data-target="#modal-pemasukan-tunai">
                                                    {{$jadwal->matkul->name}}
                                                </button>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($jadwals as $jadwal)
                                                @if ($jadwal->hari == 5 && $jadwal->jam == $jamkul->id)
                                                <button type="button" class="btn btn-xs btn-danger text-xs m-1"
                                                    data-toggle="modal" data-target="#modal-pemasukan-tunai">
                                                    {{$jadwal->matkul->name}}
                                                </button>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($jadwals as $jadwal)
                                                @if ($jadwal->hari == 6 && $jadwal->jam == $jamkul->id)
                                                <button type="button" class="btn btn-xs btn-danger text-xs m-1"
                                                    data-toggle="modal" data-target="#modal-pemasukan-tunai">
                                                    {{$jadwal->matkul->name}}
                                                </button>
                                                @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>Waktu</th>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jumat</th>
                                        <th>Sabtu</th>
                                    </tfoot>
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
<div class="modal fade" id="modal-pemasukan-tunai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Transaksi Pemasukan Kas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<!-- DataTables -->
<script>
    $(function () {
            $('#DataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX":true,
            });
        });
</script>
@stop

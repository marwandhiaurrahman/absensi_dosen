@extends('adminlte::page')

@section('title', 'Absensi Kuliah')

@section('content_header')
<h1>Absensi Kuliah</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Absensi Kuliah</h3>
                    <div class="card-tools">
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
                                            <th>No.</th>
                                            <th>Mata Kuliah</th>
                                            <th>Dosen</th>
                                            <th>Kelas</th>
                                            <th>Ruangan</th>
                                            <th>Jam</th>
                                            <th>Jumlah Pertemuan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwals as $jadwal)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{$jadwal->matkul->name}}</td>
                                            <td>{{$jadwal->matkul->dosen->name}}</td>
                                            <td>{{$jadwal->kelas->kode}}</td>
                                            <td>{{$jadwal->ruangan->kode}}</td>
                                            <td>{{$jadwal->jamkul->masuk}} sd.<br>{{$jadwal->jamkul->keluar}}
                                                {{$jadwal->jamkul->sks}} SKS</td>
                                            <td>0</td>
                                            <td>
                                                {{-- @can('absensi-edit') --}}
                                                <a class="btn btn-xs btn-success"
                                                    href="{{ route('absensi.show',$jadwal->id) }}">Show</a>
                                                {{-- @endcan --}}
                                            </td>
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
@foreach ($jadwals as $jadwal)
<div class="modal fade" id="modal-{{$jadwal->kode}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Absensi Kuliah</h4>
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

                {!! Form::model($jadwal, ['method' => 'PATCH','route' => ['jadwal.update', $jadwal],'files' => false])
                !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Hari :</strong>
                            {!! Form::select('hari',
                            [1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu'],
                            null, ['class'=>'form-control', 'placeholder'=>'Pilih Hari', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Jam :</strong>
                            <select name="jam" class="form-control" required>
                                <option disabled>Pilih Jam Kuliah</option>
                                @foreach ($jamkuls as $jamkul)
                                <option value="{{$jamkul->id}}" {{ $jamkul->id == $jadwal->jam ? 'selected' : '' }}>
                                    {{$jamkul->masuk}} - {{$jamkul->keluar}} -
                                    {{$jamkul->sks}} SKS</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Kelas :</strong>
                            {!! Form::select('kelas_id', $kelass->pluck('kode','id'), null, ['class'=>'form-control',
                            'placeholder'=>'Pilih Kelas', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Mata Kuliah :</strong>
                            {!! Form::select('matkul_id', $matkuls->pluck('name','id'), null, ['class'=>'form-control',
                            'placeholder'=>'Pilih Mata Kuliah', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ruangan :</strong>
                            {!! Form::select('ruangan_id', $ruangans->pluck('kode','id'), null,
                            ['class'=>'form-control',
                            'placeholder'=>'Pilih Ruangan', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Update', ['class'=>'btn btn-primary','onclick'=>"submitForm(this);"]) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
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
            });
        });
</script>
@stop

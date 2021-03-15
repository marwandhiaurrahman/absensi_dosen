@extends('adminlte::page')

@section('title', 'Detail Jadwal Mata Kuliah')

@section('content_header')
<h1>Detail Jadwal Mata Kuliah</h1>
@stop

@section('content')
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <h6>Mata Kuliah : {{$jadwal->matkul->name}}</h6>
        <h6>Dosen : {{$jadwal->matkul->dosen->name}}</h6>
        <h6>Kelas : {{$jadwal->kelas->kode}}</h6>
        <h6>Ruangan : {{$jadwal->ruangan->kode}}</h6>
        <h6>Jumlah Pertemuan : 0</h6>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Absensi Pertemuan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-success m-1" data-toggle="modal"
                        data-target="#modal-pemasukan-tunai">
                        + Pemasukan Kas
                    </button>
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
                                        <th width="50px">Pertemuan</th>
                                        <th width="100px">Tanggal</th>
                                        <th width="150px">Metode</th>
                                        <th>Pembahasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $absensi)
                                    <tr>
                                        <td>{{$absensi->pertemuan}}</td>
                                        <td>{{$absensi->tanggal}}</td>
                                        <td>{{$absensi->metode}}</td>
                                        <td>{{$absensi->pembahasan}}</td>
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
<div class="modal fade" id="modal-pemasukan-tunai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Absensi Pertemuan Ke-1</h4>
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
                {!! Form::open(array('route' => 'absensi.store','method'=>'POST')) !!}
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
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

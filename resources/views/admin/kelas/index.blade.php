@extends('adminlte::page')

@section('title', 'Kelas')

@section('content_header')
<h1>Kelas</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kelas</h3>
                    <div class="card-tools">
                        @can('kelas-setup')
                        <a class="btn btn-sm btn-success" href="{{ route('kelas.create') }}">+ Tambah Kelas</a>
                        @endcan
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
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Name</th>
                                            <th>Tahun Angkatan</th>
                                            <th>Program Studi</th>
                                            <th>Fakultas</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelass as $kela)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $kela->kode }}</td>
                                            <td>{{ $kela->name }}</td>
                                            <td>{{ $kela->tahun }}</td>
                                            <td>{{ $kela->prodi->name }}</td>
                                            <td>{{ $kela->prodi->fakultas->name }}</td>
                                            <td>
                                                @can('kelas-setup')
                                                <form action="{{ route('kelas.destroy',$kela) }}" method="POST">
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('kelas.edit',$kela) }}">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                                @endcan
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
@endsection

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

@extends('adminlte::page')

@section('title', 'Mata Kuliah')

@section('content_header')
<h1>Mata Kuliah</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mata Kuliah</h3>
                    <div class="card-tools">
                        @can('matkul-setup')
                        <a class="btn btn-sm btn-success" href="{{ route('matkul.create') }}">+ Tambah Mata Kuliah</a>
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
                                            <th>Dosen Pengajar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matkuls as $matkul)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $matkul->kode }}</td>
                                            <td>{{ $matkul->name }}</td>
                                            <td>{{ $matkul->dosen->name }}</td>
                                            <td>
                                                @can('matkul-setup')
                                                <form action="{{ route('matkul.destroy',$matkul->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('matkul.edit',$matkul->id) }}">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Details</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </tr>
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

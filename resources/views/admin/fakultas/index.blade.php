@extends('adminlte::page')

@section('title', 'Fakultas')

@section('content_header')
<h1>Fakultas</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Fakultas</h3>
                    <div class="card-tools">
                        {{-- @can('fakulta-create') --}}
                        <a class="btn btn-sm btn-success" href="{{ route('fakultas.create') }}">+ Tambah Fakultas</a>
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
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Kode</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fakultas as $fakulta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $fakulta->name }}</td>
                                            <td>{{ $fakulta->kode }}</td>
                                            <td>
                                                <form action="{{ route('fakultas.destroy',$fakulta->id) }}"
                                                    method="POST">
                                                    {{-- @can('fakultas-edit') --}}
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('fakultas.edit',$fakulta->id) }}">Edit</a>
                                                    {{-- @endcan --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- @can('fakultas-delete') --}}
                                                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                                    {{-- @endcan --}}
                                                </form>
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

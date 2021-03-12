@extends('adminlte::page')

@section('title', 'Program Studi')

@section('content_header')
<h1>Program Studi</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Program Studi</h3>
                    <div class="card-tools">
                        {{-- @can('ruangan-create') --}}
                        <a class="btn btn-sm btn-success" href="{{ route('ruangan.create') }}">+ Tambah Program Studi</a>
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
                                            <th>Kode</th>
                                            <th>Name</th>
                                            <th>Lantai</th>
                                            <th>Gedung</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ruangans as $ruangan)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $ruangan->kode }}</td>
                                            <td>{{ $ruangan->name }}</td>
                                            <td>{{ $ruangan->lantai }}</td>
                                            <td>{{ $ruangan->gedung->name }}</td>
                                            <td>
                                                <form action="{{ route('ruangan.destroy',$ruangan->id) }}"
                                                    method="POST">
                                                    {{-- @can('ruangan-edit') --}}
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('ruangan.edit',$ruangan->id) }}">Edit</a>
                                                    {{-- @endcan --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- @can('ruangan-delete') --}}
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

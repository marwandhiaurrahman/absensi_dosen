@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
<h1>Role</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Role</h3>
                    <div class="card-tools">
                        @can('role-setup')
                        <a href="{{route('roles.create')}}" class="btn btn-sm btn-success">Tambah Role</a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="DataTable" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Keterangan</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @can('role-setup')
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                                                $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) !!}
                                                {!! Form::close() !!}
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
                "scrollX":true,
            });
        });
</script>
@stop

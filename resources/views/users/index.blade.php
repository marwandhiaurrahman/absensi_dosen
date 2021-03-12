@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>User</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                    <div class="card-tools">
                        @can('user-setup')
                        <a href="{{route('users.create')}}" class="btn btn-sm btn-success">Tambah Pengguna</a>
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
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @can('user-setup')
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',
                                                $user->id],'style'=>'display:inline']) !!}
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

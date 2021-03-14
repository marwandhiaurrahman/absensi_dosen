@extends('adminlte::page')

@section('title', 'Jam Kuliah')

@section('content_header')
<h1>Jam Kuliah</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Jam Kuliah</h3>
                    <div class="card-tools">
                        {{-- @can('jamkul-create') --}}
                        <a class="btn btn-sm btn-success" href="{{ route('jamkul.create') }}">+ Tambah Jam Kuliah</a>
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
                                            <th>Waktu Masuk</th>
                                            <th>Waktu Keluar</th>
                                            <th>Jumlah SKS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jamkuls as $jamkul)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $jamkul->masuk }}</td>
                                            <td>{{ $jamkul->keluar }}</td>
                                            <td>{{ $jamkul->sks }}</td>
                                            v
                                            <td>
                                                <form action="{{ route('jamkul.destroy',$jamkul->id) }}"
                                                    method="POST">
                                                    {{-- @can('jamkul-edit') --}}
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('jamkul.edit',$jamkul->id) }}">Edit</a>
                                                    {{-- @endcan --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- @can('jamkul-delete') --}}
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
                                                <th>Waktu Masuk</th>
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

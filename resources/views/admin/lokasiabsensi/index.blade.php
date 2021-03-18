@extends('adminlte::page')

@section('title', 'Lokasi Absensi')

@section('content_header')
<h1>Lokasi Absensi</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Lokasi Absensi</h3><br>
                    <div class="d-block" id="locationanda"></div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" onclick="handlePermission()">Dapatkan
                            Lokasi Anda</button>
                        @can('lokasi-absensi-setup')
                        <a class="btn btn-sm btn-success" href="{{ route('lokasi-absensi.create') }}">+ Tambah Lokasi
                            Absensi</a>
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
                                            <th>Name</th>
                                            <th>Koordinat ( Latitude , Longitude )</th>
                                            <th>Jarak Minimal Absensi</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $location->name }}</td>
                                            <td>( {{$location->location->getLat()}} , {{$location->location->getLng()}}
                                                )</td>
                                            <td>{{ $location->jarak_min }} meter</td>
                                            <td>
                                                @can('lokasi-absensi-setup')
                                                <form action="{{ route('lokasi-absensi.destroy',$location->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('lokasi-absensi.edit',$location->id) }}">Edit</a>
                                                    {{-- @endcan --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- @can('lokasi-absensi-delete') --}}
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
                                            <th>Koordinat ( Latitude , Longitude )</th>
                                            <th>Jarak Minimal Absensi</th>
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

<script type="text/javascript">
    var y = document.getElementById("locationanda");

function getLocationAnda() {
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
} else {
y.innerHTML = "Geolocation is not supported by this browser.";
}
}

function tampilPosition(position) {
y.innerHTML = "Koordinat Lokasi Anda : ( " + position.coords.latitude +" , "  + position.coords.longitude + " )";
}
function tampilError(error) {
switch(error.code) {
case error.PERMISSION_DENIED:
  y.innerHTML = "User denied the request for Geolocation."
  break;
case error.POSITION_UNAVAILABLE:
  y.innerHTML = "Location information is unavailable."
  break;
case error.TIMEOUT:
  y.innerHTML = "The request to get user location timed out."
  break;
case error.UNKNOWN_ERROR:
  y.innerHTML = "An unknown error occurred."
  break;
}
}

function handlePermission() {
  navigator.permissions.query({name:'geolocation'}).then(function(result) {
    if (result.state == 'granted') {
        navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
    } else if (result.state == 'prompt') {
        navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
    } else if (result.state == 'denied') {
        navigator.geolocation.getCurrentPosition(tampilPosition, tampilError);
    }

  });
}
</script>

@stop

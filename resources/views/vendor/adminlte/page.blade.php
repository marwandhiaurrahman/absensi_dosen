@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
@php( $def_container_class = 'container' )
@else
@php( $def_container_class = 'container-fluid' )
@endif

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
<div class="wrapper">

    {{-- Top Navbar --}}
    @if($layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.navbar.navbar-layout-topnav')
    @else
    @include('adminlte::partials.navbar.navbar')
    @endif

    {{-- Left Main Sidebar --}}
    @if(!$layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.sidebar.left-sidebar')
    @endif

    {{-- Content Wrapper --}}
    <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

        {{-- Content Header --}}
        <div class="content-header">
            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                @yield('content_header')
            </div>
        </div>

        {{-- Main Content --}}
        <div class="content">
            <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                @yield('content')
            </div>
        </div>

    </div>

    {{-- Footer --}}
    @hasSection('footer')
    @include('adminlte::partials.footer.footer')
    @endif

    {{-- Right Control Sidebar --}}
    @if(config('adminlte.right_sidebar'))
    @include('adminlte::partials.sidebar.right-sidebar')
    @endif

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
<script type="text/javascript">
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
        // a_p = "AM";
        } else {
        // a_p = "PM";
        }
        if (curr_hour == 0) {
        curr_hour = 12;
        }
curr_hour = checkTime(curr_hour);
curr_minute = checkTime(curr_minute);
curr_second = checkTime(curr_second);
document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
}

function checkTime(i) {
if (i < 10) {
i = "0" + i;
}
return i;
}
setInterval(showTime, 500);
//
    -->
</script>
<script>
    var x = document.getElementById("location");
function getLocation() {
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(showPosition);
} else {
x.innerHTML = "Geolocation is not supported by this browser.";
}
}

function showPosition(position) {
x.innerHTML = "Koodinat Lokasi Anda : ( " + position.coords.latitude +" , " + position.coords.longitude+" )";
}
setInterval(getLocation, 500);
</script>
@stop

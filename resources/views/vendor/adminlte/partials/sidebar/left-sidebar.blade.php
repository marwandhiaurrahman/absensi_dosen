<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <div class="user-panel mt-2 pb-3 mb-3 d-flex">
            <div class="info">
                <a class="d-block">
                    <div class="d-block" id="tanggal">Tanggal Hari Ini </div>
                </a>
                <a class="d-block">
                    <div class="d-block" id="clock">Jam : 00:00:00 WIB </div>
                </a>
                <a class="d-block">Koordinat Lokasi Anda :<br>
                    <div class="d-block" id="location"></div>
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300)
                data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

<script type="text/javascript">
        function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour == 0) {
        curr_hour = 12;
        }
    curr_hour = checkTime(curr_hour);
    curr_minute = checkTime(curr_minute);
    curr_second = checkTime(curr_second);
    document.getElementById('clock').innerHTML="Jam : "+curr_hour + ":" + curr_minute + ":" + curr_second + " WIB";
    }
    function checkTime(i) {
    if (i < 10) {
    i = "0" + i;
    }
return i;
}
setInterval(showTime, 500);

var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
var date = new Date();
var day = date.getDate();
var month = date.getMonth();
var thisDay = date.getDay(),
thisDay = myDays[thisDay];
var yy = date.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;
document.getElementById('tanggal').innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;

function successCallback(position) {
}

var x = document.getElementById("location");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    x.innerHTML = "Longitude : " + position.coords.latitude +"<br>Latitude : " + position.coords.longitude;
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
}

setInterval(getLocation, 500);
</script>

</aside>

<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')

        <li class="nav-item">
            <a class="nav-link">
                <div class="row">

                    <!-- Menampilkan Hari, Bulan dan Tahun -->
                    <script type='text/javascript'>
                        <!--
                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
var date = new Date();
var day = date.getDate();
var month = date.getMonth();
var thisDay = date.getDay(),
thisDay = myDays[thisDay];
var yy = date.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;
document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
//
                        -->
                    </script>
                    &emsp;
                    <!-- Menampilkan Jam (Aktif) -->
                    <p>Jam :&nbsp;</p>
                    <div id="clock">00:00:00 </div>&nbsp;WIB
                    &emsp;

                    <p id="location"></p>

                </div>
            </a>
        </li>
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
        @if(config('adminlte.usermenu_enabled'))
        @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
        @else
        @include('adminlte::partials.navbar.menu-item-logout-link')
        @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
        @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>

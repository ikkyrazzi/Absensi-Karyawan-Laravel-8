<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/">Absensi Karyawan</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/">S</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard Admin</li>
        <li class="">
            <a class="nav-link" href="/"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        </li>

        <li class="menu-header">Kelola Data</li>

        <li class="">
            {{-- <a class="nav-link" href="{{ route('tampilan.apps.index') }}"><i class="fa fa-mobile" aria-hidden="true"></i> <span>Data Aplikasi</span></a> --}}
            <a class="nav-link" href="{{ route('admin.admins.index') }}"><i class="fa fa-user" aria-hidden="true"></i> <span>Admin</span></a>
        </li>

        <li class="">
            {{-- <a class="nav-link" href="{{ route('tampilan.apps.index') }}"><i class="fa fa-mobile" aria-hidden="true"></i> <span>Data Aplikasi</span></a> --}}
            <a class="nav-link" href="{{ route('admin.karyawans.index') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Karyawan</span></a>
        </li>
        
        <li class="menu-header">Absensi</li>
        <li class="">
            <a class="nav-link" href="{{ route('admin.absens.index') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Absen Karyawan</span></a>
        </li>

    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <a href="{{ route('logout') }}" method="POST" class="btn btn-dark btn-lg btn-block btn-icon-split"> <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
    </div>
</aside>

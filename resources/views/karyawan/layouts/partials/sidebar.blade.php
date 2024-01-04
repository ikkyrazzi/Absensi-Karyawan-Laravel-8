<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/">Absensi Karyawan</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/">S</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard Karyawan</li>
        <li class="">
            <a class="nav-link" href="/"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        </li>

        <li class="menu-header">Absensi Karyawan</li>
        <li class="">
            {{-- <a class="nav-link" href="{{ route('tampilan.books.index') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Data Buku</span></a> --}}
            <a class="nav-link" href="{{ route('karyawan.absens.indexKaryawan') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Absen Masuk</span></a>
        </li>
        <li class="">
            {{-- <a class="nav-link" href="{{ route('tampilan.books.index') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Data Buku</span></a> --}}
            <a class="nav-link" href="{{ route('karyawan.absens.edit', auth()->user()->id) }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Absen Pulang</span></a>
        </li>

        {{-- <li class="menu-header">Kelola Serial</li>
        <li class="nav-item dropdown">
            <a href="/home" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-key" aria-hidden="true"></i> <span>Serial</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('tampilan.serials.create') }}">Generate Serial</a></li>
                <li><a class="nav-link" href="{{ route('tampilan.serials.show', ['id_proses' => 'id_proses']) }}">Reset Serial</a></li>
                <li><a class="nav-link" href="{{ route('tampilan.serials.index') }}">Data Serial</a></li>
            </ul>
        </li> --}}

    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <a href="{{ route('logout') }}" method="POST" class="btn btn-dark btn-lg btn-block btn-icon-split"> <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
    </div>
</aside>

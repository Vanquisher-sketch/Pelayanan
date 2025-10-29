<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-landmark"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Layanan Tawang</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        UTAMA
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('permohonan.index')}}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Permohonan Layanan</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        MANAJEMEN KONTEN
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonten"
            aria-expanded="true" aria-controls="collapseKonten">
            <i class="fas fa-fw fa-desktop"></i>
            <span>Manajemen Website</span>
        </a>
        <div id="collapseKonten" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pengumuman.index')}}">Manajemen Pengumuman</a>
                <a class="collapse-item" href="{{ route('galeri.index')}}">Manajemen Galeri</a>
                <a class="collapse-item" href="{{ route('banner.index')}}">Manajemen Banner</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        DATA MASTER
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataMaster"
            aria-expanded="true" aria-controls="collapseDataMaster">
            <i class="fas fa-fw fa-database"></i>
            <span>Manajemen Data</span>
        </a>
        <div id="collapseDataMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('layanan.index')}}">Manajemen Layanan</a>
                <a class="collapse-item" href="{{ route('seksi.index')}}">Manajemen Seksi</a>
                <a class="collapse-item" href="#">Manajemen Pengguna</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        PELAPORAN
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Laporan</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
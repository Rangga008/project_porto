<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #27292e">
    <!-- Brand Logo -->
    @auth
        @if (Auth::guard('admin')->check())
            <a class="brand-link" style="text-decoration: none; margin:auto" href="{{ route('admin.dashboard') }}">
                <img class="brand-image" src="{{ asset('img/logo_undip.png') }}" style="margin-left:5px; margin-right:0px"
                    alt="..." />
                <span class="brand-text" style="font-size: large; margin-left:10px"> Universitas Diponegoro</span>
            </a>
        @elseif (Auth::guard('mahasiswa')->check())
            <a class="brand-link" style="text-decoration: none; margin:auto" href="{{ url('/mahasiswa') }}">
                <img class="brand-image" src="{{ asset('img/logo_undip.png') }}" style="margin-left:5px; margin-right:0px"
                    alt="..." />
                <span class="brand-text" style="font-size: large; margin-left:10px"> Universitas Diponegoro</span>
            </a>
        @endif
    @endauth
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info" style="margin: auto">
                <a class="d-block" style="text-decoration: none; ">{{ Auth::user()->nama }}</a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @auth
                    @if (Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a href="/kelola_mahasiswa" class="nav-link ">
                                <!-- Change Link -->
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    Kelola Mahasiswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/verif_prestasi" class="nav-link">
                                <!-- Change Link -->
                                <i class="fas fa-medal nav-icon"></i>
                                <p>
                                    Verifikasi Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/verif_project" class="nav-link">
                                <!-- Change Link -->
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Verifikasi Project
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/verif_jurnal" class="nav-link">
                                <!-- Change Link -->
                                <i class="fas fa-book nav-icon"></i>
                                <p>
                                    Verifikasi Jurnal
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/verif_kegiatan" class="nav-link">
                                <!-- Change Link -->
                                <i class="fas fa-id-card nav-icon"></i>
                                <p>
                                    Verifikasi Kegiatan
                                </p>
                            </a>
                        </li>
                    @elseif (Auth::guard('mahasiswa')->check())
                        <li class="nav-item">
                            <a href="/prestasi" class="nav-link">
                                <i class="fas fa-medal nav-icon"></i>
                                <p>Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/project" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Project</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jurnal" class="nav-link">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Jurnal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kegiatan" class="nav-link">
                                <i class="fas fa-id-card nav-icon"></i>
                                <p>Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/verifikasi" class="nav-link">
                                <i class="fas fa-desktop nav-icon"></i>
                                <p>Tampilkan Portofolio</p>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

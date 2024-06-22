<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/img/logo_undip.png') }}" rel="icon">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> <!-- Change app name --> --}}
    <title>Aplikasi Portofolio Mahasiswa</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link href="{{ asset('landing_page/css/style.css') }}" rel="stylesheet"> --}}

    <!-- For Ajax -->
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />

    @yield('extra-css')

    @yield('inline-css')
    <link href="{{ asset('landing_page/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Dosis", sans-serif;
        }
    </style>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing_page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed mt-0">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm" style="margin-left: 0px">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Kembali</a>
                    </li>
                </ul>
        </nav>
        <section class="content">
            <div class="container-fluid p-0">
                <div class="toast" style="float: right; width:265px">
                    <div class="toast-header">
                        <i class="bi bi-wifi"></i>&nbsp;&nbsp;&nbsp;
                        <strong class="mr-auto"><span class="text-success">You are online now</span></strong>
                        <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <!-- Portofolio Section -->
                @csrf
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper ml-0" style="margin-top:-60px; margin-bottom:-60px">
                    <!-- ======= Biodata Section ======= -->
                    <section id="hero" class="d-flex align-items-center"
                        style="height: 40vh; background-color:#f4f6f9">
                        <div class="container" style="padding-top: 30px">
                            <div class="row">
                                @foreach ($mahasiswa as $mhs)
                                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                                        style="align-items: center">
                                        <img src="{{ $mhs->image ? asset('storage/images/' . $mhs->image) : asset('storage/images/blank.png') }}"
                                            alt="..." class="rounded-circle" width="150">
                                    </div>
                                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                                        <div class="row" style="margin-bottom: 5px">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nama</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $mhs->nama }}
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">NIM</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $mhs->nim }}
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Fakultas</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $mhs->fakultas }}
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Program Studi</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $mhs->prodi }}
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $mhs->email }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section><!-- End Biodata -->

                    <main id="main">
                        <!-- ======= Achievement Section ======= -->
                        <section id="about" class="about">
                            <div class="container">
                                <div class="row">
                                    @if (count($prestasi) > 0)
                                        <div
                                            class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center px-lg-5">
                                            <h3>Prestasi</h3>
                                            @foreach ($prestasi as $prs)
                                                <div class="icon-box" style="margin-top:15px;">
                                                    <div class="icon">{{ $loop->iteration }}</div>
                                                    <h4 class="title"><a
                                                            style="text-decoration: none">{{ $prs->judul }}</a></h4>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $prs->penyelenggara }}</p>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $prs->periode }}</p>
                                                    @if ($prs->status == 'Menunggu Verifikasi')
                                                        <p class="description">(Belum diverifikasi)</p>
                                                    @elseif ($prs->status == 'Telah diverifikasi')
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($project) > 0)
                                        <div
                                            class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch px-lg-5">
                                            <h3>Project</h3>
                                            @foreach ($project as $prj)
                                                <div class="icon-box" style="margin-top:15px;">
                                                    <div class="icon">{{ $loop->iteration }}</div>
                                                    <h4 class="title"><a
                                                            style="text-decoration: none">{{ $prj->judul }}</a></h4>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $prj->deskripsi }}</p>
                                                    @if ($prj->status == 'Menunggu Verifikasi')
                                                        <p class="description">(Belum diverifikasi)</p>
                                                    @elseif ($prj->status == 'Telah diverifikasi')
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($jurnal) > 0)
                                        <div
                                            class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch px-lg-5">
                                            <h3>Jurnal</h3>
                                            @foreach ($jurnal as $jrnl)
                                                <div class="icon-box" style="margin-top:15px;">
                                                    <div class="icon">{{ $loop->iteration }}</div>
                                                    <h4 class="title"><a
                                                            style="text-decoration: none">{{ $jrnl->judul }}</a></h4>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $jrnl->penulis }}</p>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $jrnl->jurnal }}</p>
                                                    @if ($jrnl->status == 'Menunggu Verifikasi')
                                                        <p class="description">(Belum diverifikasi)</p>
                                                    @elseif ($jrnl->status == 'Telah diverifikasi')
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($kegiatan) > 0)
                                        <div
                                            class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch px-lg-5">
                                            <h3>Kegiatan</h3>
                                            @foreach ($kegiatan as $kgt)
                                                <div class="icon-box" style="margin-top:15px;">
                                                    <div class="icon">{{ $loop->iteration }}</div>
                                                    <h4 class="title"><a
                                                            style="text-decoration: none">{{ $kgt->jabatan }}</a></h4>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $kgt->kegiatan }}</p>
                                                    <p class="description" style="margin-bottom: 0rem">
                                                        {{ $kgt->periode }}</p>
                                                    @if ($kgt->status == 'Menunggu Verifikasi')
                                                        <p class="description">(Belum diverifikasi)</p>
                                                    @elseif ($kgt->status == 'Telah diverifikasi')
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </section><!-- End Achievement Section -->

                        <!-- ======= Certificate Section ======= -->
                        <section id="portfolio" class="portfolio section-bg">
                            <div class="container">

                                <div class="section-title">
                                    <h2>Portofolio</h2>
                                    
                                        @if (count($prestasi) == 0 && count($project) == 0 && count($jurnal) == 0 && count($kegiatan) == 0)
                                          <p>Mahasiswa ini belum memiliki portofolio</p>
                                        @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <ul id="portfolio-flters">
                                            <li data-filter="*" class="filter-active">All</li>
                                            <li data-filter=".filter-sertif">Sertifikat</li>
                                            <li data-filter=".filter-project">Project</li>
                                            <li data-filter=".filter-jurnal">Jurnal</li>
                                            <li data-filter=".filter-kegiatan">Kegiatan</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row portfolio-container">
                                    @foreach ($prestasi as $prs)
                                        <div class="col-lg-4 col-md-6 portfolio-item filter-sertif">
                                            <div class="portfolio-wrap">
                                                <img src="{{ asset('storage/images/' . $prs->image) }}"
                                                    class="img-fluid" alt="">
                                                <div class="portfolio-info">
                                                    <div class="portfolio-links">
                                                        <a href="{{ asset('storage/images/' . $prs->image) }}"
                                                            data-gallery="portfolioGallery"
                                                            class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($project as $prj)
                                        <div class="col-lg-4 col-md-6 portfolio-item filter-project">
                                            <div class="portfolio-wrap">
                                                <img src="{{ asset('storage/images/' . $prj->image) }}"
                                                    class="img-fluid" alt="">
                                                <div class="portfolio-info">
                                                    <div class="portfolio-links">
                                                        <a href="{{ asset('storage/images/' . $prj->image) }}"
                                                            data-gallery="portfolioGallery"
                                                            class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($jurnal as $jrnl)
                                        <div class="col-lg-4 col-md-6 portfolio-item filter-jurnal">
                                            <div class="portfolio-wrap">
                                                <embed src="{{ asset('storage/files/' . $jrnl->file) }}"
                                                    class="img-fluid" alt="">
                                                <div class="portfolio-info">
                                                    <div class="portfolio-links">
                                                        <a href="{{ asset('storage/files/' . $jrnl->file) }}"
                                                            data-gallery="portfolioGallery"
                                                            class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($kegiatan as $kgt)
                                        <div class="col-lg-4 col-md-6 portfolio-item filter-kegiatan">
                                            <div class="portfolio-wrap">
                                                <img src="{{ asset('storage/images/' . $kgt->image) }}"
                                                    class="img-fluid" alt="">
                                                <div class="portfolio-info">
                                                    <div class="portfolio-links">
                                                        <a href="{{ asset('storage/images/' . $kgt->image) }}"
                                                            data-gallery="portfolioGallery"
                                                            class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section><!-- End Portfolio Section -->
                    </main><!-- End #main -->
                </div>

            </div><!-- /.container-fluid -->
        </section>

        <footer class="main-footer ml-0">
            <strong>&copy; Clamerry.</strong>
            <div class="float-right d-none d-sm-inline-block">
                {{-- <b>Version</b> 3.2.0-rc --}}
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>

    <!-- JQVMap -->
    <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- daterangepicker -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('lte/dist/js/pages/dashboard.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <!-- JQuery -->
    {{-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        var status = 'online';
        var current_status = 'online';

        function checkConnection() {
            if (navigator.onLine) {
                status = 'online';
            } else {
                status = 'offline'
            }
            if (current_status != status) {
                if (status == 'online') {
                    $('i.bi').addClass('bi-wifi');
                    $('i.bi').removeClass('bi-wifi-off');
                    $('.mr-auto').html("<span class='text-success'>Koneksi terhubung kembali</span>");


                } else {
                    $('i.bi').addClass('bi-wifi-off');
                    $('i.bi').removeClass('bi-wifi');
                    $('.mr-auto').html("<span class='text-danger'>Koneksi terputus</span>");
                }

                current_status = status;

                $('.toast').toast({
                    autohide: false
                });

                $('.toast').toast('show');
            }
        }

        checkConnection();
        setInterval(() => {
            checkConnection();
        }, 1000);
    </script>


    @yield('extra-package')
    @yield('inlinejs')
    <!-- Vendor JS Files -->
    <script src="{{ asset('landing_page/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('landing_page/js/main.js') }}"></script>
    @yield('flashMessage')
</body>


</html>

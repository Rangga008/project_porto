@section('inline-css')
    {{-- <link href="{{ asset('landing_page/test.css') }}" rel="stylesheet"> --}}
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
@endsection

@extends('layouts.auth.app')

@section('content')
    @csrf
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top:-60px; margin-bottom:-60px">
        <!-- ======= Biodata Section ======= -->
        <section id="hero" class="d-flex align-items-center" style="height: 40vh; background-color:#f4f6f9">
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
                                        <h4 class="title"><a style="text-decoration: none">{{ $prs->judul }}</a></h4>
                                        <p class="description" style="margin-bottom: 0rem">{{ $prs->penyelenggara }}</p>
                                        <p class="description" style="margin-bottom: 0rem">{{ $prs->periode }}</p>
                                        @if ($prs->status == 'Menunggu Verifikasi')
                                            <p class="description">(Belum diverifikasi)</p>
                                        @elseif ($prs->status == 'Telah diverifikasi')
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (count($project) > 0)
                            <div class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch px-lg-5">
                                <h3>Project</h3>
                                @foreach ($project as $prj)
                                    <div class="icon-box" style="margin-top:15px;">
                                        <div class="icon">{{ $loop->iteration }}</div>
                                        <h4 class="title"><a style="text-decoration: none">{{ $prj->judul }}</a></h4>
                                        <p class="description" style="margin-bottom: 0rem">{{ $prj->deskripsi }}</p>
                                        @if ($prj->status == 'Menunggu Verifikasi')
                                            <p class="description">(Belum diverifikasi)</p>
                                        @elseif ($prj->status == 'Telah diverifikasi')
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (count($jurnal) > 0)
                            <div class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch px-lg-5">
                                <h3>Jurnal</h3>
                                @foreach ($jurnal as $jrnl)
                                    <div class="icon-box" style="margin-top:15px;">
                                        <div class="icon">{{ $loop->iteration }}</div>
                                        <h4 class="title"><a style="text-decoration: none">{{ $jrnl->judul }}</a></h4>
                                        <p class="description" style="margin-bottom: 0rem">{{ $jrnl->penulis }}</p>
                                        <p class="description" style="margin-bottom: 0rem">{{ $jrnl->jurnal }}</p>
                                        @if ($jrnl->status == 'Menunggu Verifikasi')
                                            <p class="description">(Belum diverifikasi)</p>
                                        @elseif ($jrnl->status == 'Telah diverifikasi')
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (count($kegiatan) > 0)
                            <div class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch px-lg-5">
                                <h3>Kegiatan</h3>
                                @foreach ($kegiatan as $kgt)
                                    <div class="icon-box" style="margin-top:15px;">
                                        <div class="icon">{{ $loop->iteration }}</div>
                                        <h4 class="title"><a style="text-decoration: none">{{ $kgt->jabatan }}</a></h4>
                                        <p class="description" style="margin-bottom: 0rem">{{ $kgt->kegiatan }}</p>
                                        <p class="description" style="margin-bottom: 0rem">{{ $kgt->periode }}</p>
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
                        <p></p>
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
                                    <img src="{{ asset('storage/images/' . $prs->image) }}" class="img-fluid"
                                        alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="{{ asset('storage/images/' . $prs->image) }}"
                                                data-gallery="portfolioGallery" class="portfolio-lightbox"><i
                                                    class="bx bx-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($project as $prj)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-project">
                                <div class="portfolio-wrap">
                                    <img src="{{ asset('storage/images/' . $prj->image) }}" class="img-fluid"
                                        alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="{{ asset('storage/images/' . $prj->image) }}"
                                                data-gallery="portfolioGallery" class="portfolio-lightbox"><i
                                                    class="bx bx-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($jurnal as $jrnl)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-jurnal">
                                <div class="portfolio-wrap">
                                    <embed src="{{ asset('storage/files/' . $jrnl->file) }}" class="img-fluid"
                                        alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="{{ asset('storage/files/' . $jrnl->file) }}"
                                                data-gallery="portfolioGallery" class="portfolio-lightbox"><i
                                                    class="bx bx-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($kegiatan as $kgt)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-kegiatan">
                                <div class="portfolio-wrap">
                                    <img src="{{ asset('storage/images/' . $kgt->image) }}" class="img-fluid"
                                        alt="">
                                    <div class="portfolio-info">
                                        <div class="portfolio-links">
                                            <a href="{{ asset('storage/images/' . $kgt->image) }}"
                                                data-gallery="portfolioGallery" class="portfolio-lightbox"><i
                                                    class="bx bx-plus"></i></a>
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
@endsection

@section('inlinejs')
    <!-- Vendor JS Files -->
    <script src="{{ asset('landing_page/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('landing_page/js/main.js') }}"></script>
@endsection

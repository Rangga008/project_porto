<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portofolio App</title>

    <!-- Favicons -->
    <link href="{{ asset('/img/logo_undip.png') }}" rel="icon">
    <link href="{{ asset('landing_page/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing_page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('landing_page/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @csrf
    <!-- ======= Biodata Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" style="padding-top: 30px">
            <div class="row">
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                    style="align-items: center">
                    <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('storage/images/blank.png') }}"
                        alt="..." class="rounded-circle" width="150">
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nama</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ Auth::user()->nama }}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-sm-3">
                            <h6 class="mb-0">NIM</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ Auth::user()->nim }}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Fakultas</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ Auth::user()->fakultas }}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Program Studi</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ Auth::user()->prodi }}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
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
                            <h4 class="title"><a href="">{{ $prs->judul }}</a></h4>
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
                            <h4 class="title"><a href="">{{ $prj->judul }}</a></h4>
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
                            <h4 class="title"><a href="">{{ $jrnl->judul }}</a></h4>
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
                        {{-- <br><br> --}}
                        <h3>Kegiatan</h3>
                        @foreach ($kegiatan as $kgt)
                        <div class="icon-box" style="margin-top:15px;">
                            <div class="icon">{{ $loop->iteration }}</div>
                            <h4 class="title"><a href="">{{ $kgt->jabatan }}</a></h4>
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
                            <img src="{{ asset('storage/images/' . $prs->image) }}" class="img-fluid" alt="">
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
                            <img src="{{ asset('storage/images/' . $prj->image) }}" class="img-fluid" alt="">
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
                            <embed src="{{ asset('storage/files/' . $jrnl->file) }}" class="img-fluid" alt="">
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
                            <img src="{{ asset('storage/images/' . $kgt->image) }}" class="img-fluid" alt="">
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

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="row mt-5">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="text-center">
                            {{-- <button type="submit" style="float: left">Ajukan Verifikasi</button> --}}
                            <a style="float: right; background: #49b5e7; border: 0; padding: 10px 24px; color: #fff; transition: 0.4s; border-radius: 4px;"
                                href="/mahasiswa">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Kuren</span></strong>
            </div>
            <div class="credits">
                {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing_page/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('landing_page/js/main.js') }}"></script>

</body>

</html>
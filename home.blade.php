<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Aplikasi Portofolio</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="" class="logo"><img src="img/logo_undip.png" alt="" class="img-fluid"></a>
            <!-- Uncomment below if you prefer to use text as a logo -->
            <!-- <h1 class="logo"><a href="index.html">Butterfly</a></h1> -->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#about">Info</a></li>
                    {{-- <li><a class="nav-link scrollto " href="{{ url('/search') }}">Portfolio</a></li> --}}
                    {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
                    {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}
                    <li class="dropdown"><a href="#"><span>Login</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ url('/login/admin') }}">Admin</a></li>
                            <li><a href="{{ url('/login/mahasiswa') }}">Mahasiswa</a></li>
                        </ul>
                    </li>
                    {{-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> --}}
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Aplikasi Portofolio Mahasiswa Universitas Diponegoro</h1>
                </div>
                
            </div>

            <div class="row mt-5">
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <form id="" action="{{ route('searchPorto') }}" method="POST" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <select name="mahasiswa_id" id="mahasiswaid" class="form-control" required
                                    style="width: 100%" onchange="redirectHomeHehe()"><i
                                        class="bx bx-search-alt-2"></i></select>
                                @error('mahasiswa_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="text-center"><button type="submit">Search</button></div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row">
                    <div
                        class="col-xl-5 col-lg-6 d-flex justify-content-center video-box align-items-stretch position-relative">
                        <a href="https://www.youtube.com/watch?v=9otu2wkplq0&ab_channel=UndipTVOfficial"
                            class="glightbox play-btn mb-4"></a>
                    </div>

                    <div
                        class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                        <h3>Aplikasi Portofolio Mahasiswa</h3>
                        <p style="text-align: justify;">Merupakan aplikasi bagi mahasiswa Universitas Diponegoro membuat
                            portofolio.
                            Portofolio mahasiswa dapat terdiri dari:
                        </p>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-trophy"></i></div>
                            <h4 class="title"><a href="">Prestasi</a></h4>
                            <p class="description" style="text-align: justify;">Merupakan prestasi/penghargaan dalam
                                bidang akademik dan non-akademik
                                yang diperoleh secara individu maupun kelompok selama masih tercatat aktif sebagai
                                mahasiswa.</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-task"></i></div>
                            <h4 class="title"><a href="">Project</a></h4>
                            <p class="description" style="text-align: justify;">Merupakan suatu produk, layanan, atau
                                hasil dari usaha mahasiswa yang
                                sesuai dengan kemampuan dan minat mahasiswa berdasarkan program studi.</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-news"></i></div>
                            <h4 class="title"><a href="">Jurnal</a></h4>
                            <p class="description" style="text-align: justify;">Merupakan hasil penelitian mahasiswa
                                dalam
                                bidang tertentu yang telah dipublikasikan oleh instansi, badan organisasi profesi maupun
                                lembaga keilmuan.</p>
                        </div>

                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-calendar"></i></div>
                            <h4 class="title"><a href="">Kegiatan</a></h4>
                            <p class="description" style="text-align: justify;">Kegiatan yang diikuti mahasiswa selama
                                masa perkuliahan seperti
                                organisasi, program pertukaran pelajar, program sukarelawan, program magang, dan Unit
                                Kegiatan Mahasiswa</p>
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Butterfly</h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Clamerry</span></strong>.
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/butterfly-free-bootstrap-theme/ -->
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

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        //instansiasi select2js
        $('#mahasiswaid').select2({
            placeholder: "Cari Nama Mahasiswa...",
            minimumInputLength: 2,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //syarat autentikasi
                },
                url: "{{ route('searchPorto') }}", //url aplikasi
                type: "POST",
                dataType: 'json',
                data: function(params) {
                    return {
                        name: $.trim(params.term)
                        // name itu untuk yang $request->name
                        // $.trim(params.term)  tiap ngetiknya
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.datas
                        // data pertama itu dari parameter
                        // data kedua itu dari responde()->json(['data']) -> controller
                        // data kedua harus bentuknya array ['id' => $id, 'text' => $text]
                        // <option value="id">text</option>
                    };
                },
                cache: true
            }
        });
        function redirectHomeHehe() {
            window.location = "{{ route('search.index') }}" + `/${$("#mahasiswaid").val()}`
        }
    </script>

</body>

</html>

@extends('layouts.auth.app')

@section('extra-css')
    <!-- Datatables, SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div id="login_success"></div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6" style="width: 20% !important">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #48b2e4 !important;">
                            <div class="inner">
                                <h3 class="text-white" style="font-size: 30px;">{{ $mahasiswa }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-friends" style="top:10px; font-size:40px"></i>
                            </div>
                            <p href="#" class="small-box-footer">Mahasiswa Aktif</p>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6" style="width: 20%">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #e2c64b !important;">
                            <div class="inner">
                                <h3 class="text-white" style="font-size: 30px;">
                                    {{ $prestasi['verifikasi'] }}/{{ $prestasi['total'] }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-trophy" style="top:10px; font-size:40px"></i>
                            </div>
                            <p href="#" class="small-box-footer">Prestasi</p>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6" style="width: 20%">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #e3904c !important;">
                            <div class="inner">
                                <h3 class="text-white" style="font-size: 30px;">
                                    {{ $project['verifikasi'] }}/{{ $project['total'] }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shapes" style="top:10px; font-size:40px"></i>
                            </div>
                            <p href="#" class="small-box-footer">Project</p>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6" style="width: 20%">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #e14b4c !important;">
                            <div class="inner">
                                <h3 class="text-white" style="font-size: 30px;">
                                    {{ $jurnal['verifikasi'] }}/{{ $jurnal['total'] }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-pdf" style="top:10px; font-size:40px"></i>
                            </div>
                            <p href="#" class="small-box-footer">Jurnal</p>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6" style="width: 20%">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #4be261 !important;">
                            <div class="inner">
                                <h3 class="text-white" style="font-size: 30px;">
                                    {{ $kegiatan['verifikasi'] }}/{{ $kegiatan['total'] }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-check" style="top:10px; font-size:40px"></i>
                            </div>
                            <p href="#" class="small-box-footer">Kegiatan</p>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <br>
                <h3 class="m-0">Preview Permohonan Verifikasi</h1>
                    <br>
                    {{-- Tabel Permohonan Verifikasi --}}
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="background: #49B5E7">
                                    <h5 class="text-light">Prestasi</h5>
                                </div>
                                <div class="card-body">
                                    <table id="verif_prestasi"
                                        class="table table-striped table-sm text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Prestasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPrs as $prs)
                                                <tr>
                                                    <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                    <td style="vertical-align: middle">{{ $prs->Mahasiswa->nama }}</td>
                                                    <td style="vertical-align: middle">{{ $prs->judul }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="background: #49B5E7">
                                    <h5 class="text-light">Project</h5>
                                </div>
                                <div class="card-body">
                                    <table id="verif_project" class="table table-striped table-sm text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Project</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPrj as $prj)
                                                <tr>
                                                    <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                    <td style="vertical-align: middle">{{ $prj->Mahasiswa->nama }}</td>
                                                    <td style="vertical-align: middle">{{ $prj->judul }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="background: #49B5E7">
                                    <h5 class="text-light">Jurnal</h5>
                                </div>
                                <div class="card-body">
                                    <table id="verif_jurnal"
                                        class="table table-striped table-sm text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Judul Jurnal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataJrnl as $jrnl)
                                                <tr>
                                                    <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                    <td style="vertical-align: middle">{{ $jrnl->Mahasiswa->nama }}</td>
                                                    <td style="vertical-align: middle">{{ $jrnl->judul }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="background: #49B5E7">
                                    <h5 class="text-light">Kegiatan</h5>
                                </div>
                                <div class="card-body">
                                    <table id="verif_kegiatan"
                                        class="table table-striped table-sm text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Kegiatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataKgt as $kgt)
                                                <tr>
                                                    <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                    <td style="vertical-align: middle">{{ $kgt->Mahasiswa->nama }}</td>
                                                    <td style="vertical-align: middle">{{ $kgt->kegiatan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('extra-package')
    <!-- Datatables, SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@section('flashMessage')
    @if (Session::has('successLogin'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Login berhasil!'
            })
        </script>
    @endif
@endsection

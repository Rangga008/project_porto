@section('extra-css')
    <!-- Datatables, SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@extends('layouts.auth.app')

@section('content')
    @csrf
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <a class="btn btn-primary"
                            style="float: left; background-color: #49B5E7 !important;
                        border-color: transparent;"
                            href="/admin"><i class="fas fa-arrow-left"></i></a>
                        <h4 class="m-0" style="float: right; color: #0F394C;">Verifikasi Prestasi
                        </h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Tabel Verif Prestasi -->
        <section class="content">
            <div class="container-fluid">

                <body class="bg-light">
                    <div class="container">
                        <div class="row my-5">
                            <div class="col-lg-12">
                                <div class="card shadow">
                                    <div class="card-header d-flex justify-content-between align-items-center"
                                        style="margin-top: -2rem; background: #49B5E7">
                                        <h5 class="text-light">Permohonan Verifikasi</h5>
                                        {{-- <a class="btn btn-light" href="{{ route('kelola_mahasiswa.create') }}"><i
                                                class="bi-plus-circle me-2"></i>Tambah
                                            Mahasiswa</a> --}}
                                    </div>
                                    <div class="card-body">
                                        <table id="verif_prestasi"
                                            class="table table-striped table-sm text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Prestasi</th>
                                                    <th>Sertifikat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prestasi as $prs)
                                                    <tr>
                                                        <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                        <td style="vertical-align: middle">{{ $prs->nama }}</td>
                                                        <td style="vertical-align: middle">{{ $prs->judul }}</td>
                                                        <td style="vertical-align: middle"><button type="button"
                                                                class="btn btn-outline-primary" style="" data-toggle="modal"
                                                                data-target="#sertifikat{{ $prs->id_prestasi }}">
                                                                Show
                                                            </button></td>

                                                        <td style="vertical-align: middle">
                                                            <button type="button" class="border-0"
                                                                style="background: transparent; vertical-align: middle; float:left"
                                                                onclick="acceptConfirmation('{{ $prs->id_prestasi }}')">
                                                                <i class="far fa-check-circle fa-lg"
                                                                    style="color: #00E060"></i>
                                                            </button>

                                                            <button type="button" class="border-0"
                                                                style="background: transparent; vertical-align: middle; float:left"
                                                                onclick="rejectConfirmation('{{ $prs->id_prestasi }}')">
                                                                <i class="far fa-times-circle fa-lg"
                                                                    style="color: #E11400"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($prestasi as $prs)
                        <!-- Modal View Image -->
                        <div class="modal fade" id="sertifikat{{ $prs->id_prestasi }}">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Sertifikat</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- <p>{{ $prs->id }}</p> --}}
                                        <img src="{{ asset('storage/images/' . $prs->image) }}" style="width: 100%">
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endforeach
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

        @section('inlinejs')
            <script>
                $(document).ready(function() {
                    $('#verif_prestasi').DataTable();
                });

                function acceptConfirmation(id) {
                    swal.fire({
                        title: 'Verifikasi data ini?',
                        icon: 'warning',
                        showCancelButton: false,
                        cancelButtonColor: '#d33',
                        showDenyButton: true,
                        denyButtonText: 'Batal',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Setuju'
                    }).then(function(e) {

                        if (e.value === true) {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'PUT',
                                url: "{{ url('/acc_prestasi/') }}" + `/${id}`,
                                dataType: 'JSON',
                                success: function(results) {
                                    //console.log(results);
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        swal.fire("Gagal!", results.message, "error");
                                    }
                                }
                            });

                        } else {
                            e.dismiss;
                        }

                    }, function(dismiss) {
                        return false;
                    })
                }

                function rejectConfirmation(id) {
                    swal.fire({
                        title: 'Tolak data ini?',
                        icon: 'warning',
                        showCancelButton: false,
                        cancelButtonColor: '#d33',
                        showDenyButton: true,
                        denyButtonText: 'Kembali',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Tolak'
                    }).then(function(e) {

                        if (e.value === true) {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'PUT',
                                url: "{{ url('/tolak_prestasi/') }}" + `/${id}`,
                                dataType: 'JSON',
                                success: function(results) {
                                    //console.log(results);
                                    if (results.success === true) {
                                        swal.fire("Sukses!", results.message, "success");
                                        // refresh page after 1 seconds
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        swal.fire("Gagal!", results.message, "error");
                                    }
                                }
                            });

                        } else {
                            e.dismiss;
                        }

                    }, function(dismiss) {
                        return false;
                    })
                }
            </script>
        @endsection

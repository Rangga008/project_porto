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
                        <h4 class="m-0" style="float: right; color: #0F394C;">Verifikasi Jurnal
                        </h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Tabel Verif Jurnal -->
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
                                        <table id="verif_jurnal"
                                            class="table table-striped table-sm text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Judul</th>
                                                    <th>Penulis</th>
                                                    <th>Nama Jurnal</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jurnal as $jrnl)
                                                    <tr>
                                                        <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                        <td style="vertical-align: middle">{{ $jrnl->nama }}</td>
                                                        <td style="vertical-align: middle">{{ $jrnl->judul }}</td>
                                                        <td style="vertical-align: middle">{{ $jrnl->penulis }}</td>
                                                        <td style="vertical-align: middle">{{ $jrnl->jurnal }}</td>
                                                        <td style="vertical-align: middle"><button type="button"
                                                                class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#view_file{{ $jrnl->id }}">
                                                                Show
                                                            </button>
                                                        </td>

                                                        <td style="vertical-align: middle">

                                                            <button type="button" class="border-0"
                                                                style="background: transparent; vertical-align: middle"
                                                                onclick="acceptConfirmation('{{ $jrnl->id_jurnal }}')">
                                                                <i class="far fa-check-circle fa-lg"
                                                                    style="color: #00E060"></i>
                                                            </button>

                                                            <button type="button" class="border-0"
                                                                style="background: transparent; vertical-align: middle"
                                                                onclick="rejectConfirmation('{{ $jrnl->id_jurnal }}')">
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
                    @foreach ($jurnal as $jrnl)
                        <!-- Modal View File -->
                        <div class="modal fade" id="view_file{{ $jrnl->id }}">
                            <div class="modal-dialog modal-fullscreen-xxl-down modal-dialog-scrollable"
                                style="max-width:100%;max-height:100%; margin:0">
                                <div class="modal-content" style="max-height:100%">
                                    {{-- <div class="modal-body"> --}}
                                    <embed src="{{ asset('storage/files/' . $jrnl->file) }}"
                                        style="height:500%; width: 100%">
                                    {{-- </div> --}}
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>

                        <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            @endforeach
            </body>
    </div><!-- /.container-fluid -->
    </section>

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
            $('#verif_jurnal').DataTable();
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
                        url: "{{ url('/acc_jurnal/') }}" + `/${id}`,
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
                confirmButtonText: 'Ya'
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'PUT',
                        url: "{{ url('/tolak_jurnal') }}" + `/${id}`,
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

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

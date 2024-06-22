@section('extra-css')
    <!-- Datatables, SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@extends('layouts.auth.app')

@section('flashMessage')
    @if (Session::has('success'))
        <script>
            swal.fire("Sukses!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection

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
                        <h4 class="m-0" style="float: right; color: #0F394C;">Kelola Mahasiswa
                        </h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Tabel Mahasiswa -->
        <section class="content">
            <div class="container-fluid">

                <body class="bg-light">
                    <div class="container">
                        <div class="row my-5">
                            <div class="col-lg-12">
                                <div class="card shadow">
                                    <div class="card-header d-flex justify-content-between align-items-center justify-content-md-end"
                                        style="margin-top: -2rem; background: #49B5E7">
                                        <a class="btn btn-light" href="{{ route('kelola_mahasiswa.create') }}"><i
                                                class="bi-plus-circle me-2"></i>Tambah
                                            Mahasiswa</a>
                                    </div>
                                    <div class="card-body" id="show_all_mahasiswa">
                                        <table id="tabel_mahasiswa"
                                            class="table table-striped table-sm text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>NIM</th>
                                                    <th>Fakultas</th>
                                                    <th>Program Studi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mahasiswa as $mhs)
                                                    <tr>
                                                        <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                        <td style="vertical-align: middle">{{ $mhs->nama }}</td>
                                                        <td style="vertical-align: middle">{{ $mhs->nim }}</td>
                                                        <td style="vertical-align: middle">{{ $mhs->fakultas }}</td>
                                                        <td style="vertical-align: middle">{{ $mhs->prodi }}</td>
                                                        <td style="vertical-align: middle">
                                                            <a style="margin-right:12px; text-decoration: none; vertical-align: middle"
                                                                    href="{{ route('kelola_mahasiswa.show', $mhs->id) }}">
                                                                    <i class="fas fa-info fa-lg"
                                                                        style="color: #00A9E2"></i></a>
                                                            <a style="background:transparent; text-decoration: none; vertical-align: middle"
                                                                href="{{ route('kelola_mahasiswa.edit', $mhs->id) }}">
                                                                <i class="nav-icon fas fa-edit fa-lg"
                                                                    style="color: #1c8c53"></i></a>
                                                            <a style="background:transparent; text-decoration: none; vertical-align: middle"
                                                                href="#"
                                                                onclick="deleteConfirmation('{{ $mhs->id }}')">
                                                                <i class="nav-icon far fa-trash-alt fa-lg"
                                                                    style="color: #E11400"></i></a>
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
                </body>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('extra-package')
    <!-- Datatables, SweetAlert -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
@section('inlinejs')
    <script>
        $(document).ready(function() {
            $('#tabel_mahasiswa').DataTable();
        });

        function deleteConfirmation(id) {
            swal.fire({
                title: 'Anda yakin mau menghapus data ini?',
                icon: 'warning',
                showCancelButton: false,
                cancelButtonColor: '#d33',
                showDenyButton: true,
                denyButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Hapus'
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        url: "{{ route('kelola_mahasiswa.index') }}" + `/${id}`,
                        dataType: 'JSON',
                        success: function(results) {
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

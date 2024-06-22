@extends('layouts.mahasiswa.form')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('form_only')
    <!-- Create Kegiatan Page -->
    <div class="page-wrapper bg-dark p-t-100 p-b-50" style="background: #0F394C;">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h5 class="title" style="font-size: 28px; text-align: end">Tambah Kegiatan Mahasiswa
                        <a class="btn btn--white btn--radius-2" style="float: left; text-decoration:none"
                            href="{{ route('kegiatan.index') }}"><i class="fas fa-arrow-left" style="color: #0F394C"></i></a>
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="create-kegiatan-form" action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="name">Jabatan</div>
                            <div class="value">
                                <input type="text" name="jabatan" class="input--style-6" placeholder="Jabatan" required>
                                @error('jabatan')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Nama Kegiatan</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="text" name="kegiatan" class="input--style-6"
                                        placeholder="Nama Kegiatan" required></textarea>
                                    @error('kegiatan')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Periode</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="text" name="periode" class="input--style-6" placeholder="Periode"
                                        required></textarea>
                                    @error('periode')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Foto</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="form-control" style="" type="file" name="image" id="image" required>
                                    @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="label--desc">Ukuran maksimal 3MB; dapat berupa JPG, PNG, JPEG</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn--radius-2 btn--blue-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inlinejs')
<script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#tabel_kegiatan').DataTable();
    });
</script>
@endsection

@extends('layouts.admin.form')

@section('form_only')
    <!-- Edit Jurnal Page -->
    <div class="page-wrapper bg-dark p-t-100 p-b-50" style="background: #0F394C;">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h5 class="title" style="font-size: 28px; text-align: end">Ubah Jurnal Mahasiswa
                        <a class="btn btn--white btn--radius-2" style="float: left; text-decoration:none"
                            href="{{ route('index.jurnal') }}"><i class="fas fa-arrow-left" style="color: #0F394C"> </i> </a>
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.update.jurnal', $jurnal->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="name">Mahasiswa</div>
                            <div class="input--style-6">
                                {{ $jurnal->Mahasiswa->nama }} - {{ $jurnal->Mahasiswa->fakultas }} -
                                {{ $jurnal->Mahasiswa->prodi }}
                                @error('mahasiswaid')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Judul</div>
                            <div class="value">
                                <input type="text" name="judul" class="input--style-6" placeholder="Judul"
                                    value="{{ $jurnal->judul }}" required>
                                @error('judul')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Penulis</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea type="text" name="penulis" class="input--style-6" placeholder="Penulis" value="" required>{{ $jurnal->penulis }}</textarea>
                                    <div class="label--desc">Nama penulis dipisahkan dengan tanda titik koma (;)</div>
                                    @error('penulis')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Nama Jurnal</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="text" name="jurnal" class="input--style-6"
                                        value="{{ $jurnal->jurnal }}" placeholder="Nama Jurnal" required></textarea>
                                    @error('jurnal')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">File</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="form-control" style="" type="file" name="file" id="file">
                                    <div class="label--desc">Ukuran maksimal 10MB, hanya dalam bentuk PDF</div>
                                    @error('file')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="padding-top: 1rem">
                                    <embed src="{{ asset('storage/files/' . $jurnal->file) }}" height="200"
                                        width="200" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn--radius-2 btn--blue-2"
                                onclick="update('{{ $jurnal->id }}')">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inlinejs')
    <script>
        function update(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('jurnal.index') }}" + `/${id}`,
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200) {
                        window.location.href = "{{ route('jurnal.index') }}";
                    }.then(function() {
                        Swal.fire(
                            'Sukses!',
                            'Data berhasil diubah',
                            'success'
                        )
                    });
                }
            });
        }
    </script>
@endsection

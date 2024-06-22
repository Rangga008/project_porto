@extends('layouts.admin.form')

@section('form_only')
    <!-- Edit Project Page -->
    <div class="page-wrapper bg-dark p-t-100 p-b-50" style="background: #0F394C;">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h5 class="title" style="font-size: 28px; text-align: end">Ubah Project Mahasiswa
                        <a class="btn btn--white btn--radius-2" style="float: left; text-decoration:none"
                            href="{{ route('index.project') }}"><i class="fas fa-arrow-left" style="color: #0F394C"> </i>
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.update.project', $project->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="name">Mahasiswa</div>
                            <div class="input--style-6">
                                {{ $project->Mahasiswa->nama }} - {{ $project->Mahasiswa->fakultas }} -
                                {{ $project->Mahasiswa->prodi }}
                                @error('mahasiswa_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Judul</div>
                            <div class="value">
                                <input type="text" name="judul" class="input--style-6" placeholder="Judul"
                                    value="{{ $project->judul }}" required>
                                @error('judul')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Deskripsi</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea name="deskripsi" class="textarea--style-6" placeholder="Deskripsi"required>{{ $project->deskripsi }}</textarea>
                                    <div class="label--desc">Dapat disertakan link yang bersangkutan dengan project</div>
                                    @error('deskripsi')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Foto Project</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="form-control" style="" type="file" name="image" id="image">
                                    <div class="label--desc">Ukuran maksimal 3MB; dapat berupa JPG, PNG, JPEG</div>
                                    @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="padding-top: 1rem">
                                    <img src="{{ asset('storage/images/' . $project->image) }}" height="200"
                                        width="200" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn--radius-2 btn--blue-2"
                                onclick="update('{{ $project->id }}')">Simpan</button>
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
                url: "{{ route('project.index') }}" + `/${id}`,
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200) {
                        window.location.href = "{{ route('project.index') }}";
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

@extends('layouts.admin.form')

@section('form_only')
<!-- Edit Prestasi Page -->
<div class="page-wrapper bg-dark p-t-100 p-b-50" style="background: #0F394C;">
  <div class="wrapper wrapper--w900">
    <div class="card card-6">
      <div class="card-heading">
        <h5 class="title" style="font-size: 28px; text-align: end">Ubah Prestasi Mahasiswa
          <a class="btn btn--white btn--radius-2" style="float: left; text-decoration:none"
            href="{{ route('index.prestasi') }}"><i class="fas fa-arrow-left" style="color: #0F394C"> </i> </a>
        </h5>
      </div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mb-1 mt-1">
          {{ session('status') }}
        </div>
        @endif

        <form action="{{ route('admin.update.prestasi', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="form-row">
            <div class="name">Mahasiswa</div>
            <div class="input--style-6">
              {{ $prestasi->Mahasiswa->nama }} - {{ $prestasi->Mahasiswa->fakultas }} - {{ $prestasi->Mahasiswa->prodi }}
              @error('mahasiswa')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="name">Judul</div>
            <div class="value">
              <input type="text" name="judul" class="input--style-6" placeholder="Judul" value="{{ $prestasi->judul }}"
                required>
              @error('judul')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-row">
            <div class="name">Penyelenggara</div>
            <div class="value">
              <div class="input-group">
                <input type="text" name="penyelenggara" class="input--style-6" placeholder="Penyelenggara"
                  value="{{ $prestasi->penyelenggara }}" required></textarea>
                @error('penyelenggara')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="name">Periode</div>
            <div class="value">
              <div class="input-group">
                <input type="date" name="periode" class="input--style-6" value="{{ $prestasi->periode }}"
                  placeholder="Periode" required></textarea>
                @error('periode')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="name">Piagam/Sertifikat</div>
            <div class="value">
              <div class="input-group js-input-file">
                <input class="form-control" style="" type="file" name="image" id="image">
                @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="label--desc">Ukuran maksimal 3MB; dapat berupa JPG, PNG, JPEG</div>
              <div class="form-group" style="padding-top: 1rem">
                <img src="{{ asset('storage/images/' . $prestasi->image) }}" height="200" width="200" alt="" />
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn--radius-2 btn--blue-2"
              onclick="update('{{ $prestasi->id }}')">Simpan</button>
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
        url: "{{ route('prestasi.index') }}" + `/${id}`,
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status === 200) {
                window.location.href = "{{ route('prestasi.index') }}";
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
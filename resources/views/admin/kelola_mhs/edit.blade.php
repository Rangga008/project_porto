@extends('layouts.admin.form')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('form_only')
    <!-- Edit Mahasiswa Page -->
    <div class="page-wrapper bg-dark p-b-50" style="background: #0F394C; padding-top:50px">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h5 class="title" style="font-size: 28px; text-align: end">Ubah Data Mahasiswa
                        <a class="btn btn--white btn--radius-2" style="float: left; text-decoration:none"
                            href="{{ route('kelola_mahasiswa.index') }}"><i class="fas fa-arrow-left"
                                style="color: #0F394C"> </i></a>
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('kelola_mahasiswa.update', $mahasiswa->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <input type="email" name="email" class="input--style-6" placeholder="Email"
                                    value="{{ $mahasiswa->email }}" required>
                                @error('email')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <input type="text" name="password" class="input--style-6" placeholder="Password"
                                    value="{{ $mahasiswa->password }}" required>
                                @error('password')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-row">
                            <div class="name">Nama</div>
                            <div class="value">
                                <input type="text" name="nama" class="input--style-6" placeholder="Nama Lengkap"
                                    value="{{ $mahasiswa->nama }}" required>
                                @error('nama')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">NIM</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="text" name="nim" class="input--style-6" placeholder="NIM"
                                        value="{{ $mahasiswa->nim }}" required></textarea>
                                    @error('nim')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Fakultas</div>
                            <div class="value">
                                <div class="input-group">
                                    <select name="fakultas" id="fakultas" class="input--style-6"
                                        onchange="findProdi(this)">
                                        <option value="" disabled selected>--Pilih Fakultas--</option>
                                        @foreach ($fakultas as $fk)
                                            <option value="{{ $fk->id }}"
                                                {{ strtolower($fk->nama) == strtolower($mahasiswa->fakultas) ? 'selected' : '' }}>
                                                {{ $fk->nama }}</option>
                                        @endforeach
                                    </select>
                                    {{-- this membawa semua elemen pada bagian select --}}
                                    {{-- <input type="text" name="fakultas" class="input--style-6" placeholder="Fakultas"
                                        required></textarea> --}}
                                    @error('fakultas')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Program Studi</div>
                            <div class="value">
                                <div class="input-group">
                                    <select name="prodi" id="prodi" class="input--style-6">
                                        <option value="" disabled selected>--Pilih Program Studi--</option>
                                        @foreach ($prodi as $prd)
                                            @if(strtolower($prd->nama) == strtolower($mahasiswa->prodi))
                                                <option value="{{ $prd->id }}" selected>
                                                    {{ $prd->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('prodi')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn--radius-2 btn--blue-2"
                                onclick="update('{{ $mahasiswa->id }}')">Simpan</button>
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
        function findProdi(event) {
            const fk_id = event.value;
            const fk_text = $(event).find("option:selected").text();
            $('#prodi').empty(); //clear select prodi ketika salah satu fakultas dipilih
            $('#prodi').append('<option value="" disabled selected>--Pilih Program Studi--</option>'); //nambahkan pilihan default
            $.ajax({ //fungsi ajax
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //syarat autentikasi
                },
                url: window.location.origin + "/kelola_mahasiswa/create", //url aplikasi
                type : "GET",
                dataType : "json",
                success:function(result) {
                    if(result.status == 200){
                        // console.log(result.data);
                        result.data.map( (v,i) => { //looping value dan index dari result data (dari controller)
                            if(v.id_fakultas == fk_id) { //compare id yang dipilih dengan id dari listFakultas
                                $('#prodi').append(`<option value="${v.id}">${v.nama}</option>`); //menambahkan option baru, sesuai dengan id prodi yang sama
                            }
                        });
                    }
                }
            })
        }
    </script>
@endsection

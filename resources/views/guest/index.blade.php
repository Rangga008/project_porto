{{-- <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
    <link href="{{ asset('guest/css/main.css') }}" rel="stylesheet" />
  </head>
  <body>
    <div class="s009">
      <form>
        <div class="inner-form">
          <div class="basic-search">
            <div class="input-field">
              <input id="search" type="text" placeholder="Type Keywords" />
              <div class="icon-wrap">
                <svg class="svg-inline--fa fa-search fa-w-16" fill="#ccc" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                </svg>
              </div>
            </div>
          </div>
          <div class="advance-search">
            <span class="desc">ADVANCED SEARCH</span>
            <div class="row">
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Accessories</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Color</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Size</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row second">
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Sale</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Time</option>
                    <option>Last time</option>
                    <option>Today</option>
                    <option>This week</option>
                    <option>This month</option>
                    <option>This year</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Type</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row third">
              <div class="input-field">
                <div class="result-count">
                  <span>108 </span>results</div>
                <div class="group-btn">
                  <button class="btn-delete" id="delete">RESET</button>
                  <button class="btn-search">SEARCH</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script src="{{ asset('guest/js/extention/choices.js') }}"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const deleteBtn = document.getElementById('delete')
      const choices = new Choices('select',
      {
        searchEnabled: false,
        itemSelectText: '',
        removeItemButton: true,
      });
      deleteBtn.addEventListener("click", function(e)
      {
        e.preventDefault()
        const deleteAll = document.querySelectorAll('.choices__button')
        for (let i = 0; i < deleteAll.length; i++)
        {
          deleteAll[i].click();
        }
      });

    </script>
  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html> --}}

@section('extra-css')
    <!-- Datatables, SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
    <link href="{{ asset('guest/css/main.css') }}" rel="stylesheet" />
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
        <form id="" action="{{ route('searchPorto') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="name">Mahasiswa</div>
                <div class="value" style="width: 100%">
                    <select name="mahasiswa_id" id="mahasiswaid" class="input--style-6" required style="width: 100%" onchange="redirectHomeHehe()"></select>
                    @error('mahasiswa_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn--radius-2 btn--blue-2">Search</button>
            </div>
        </form>
        {{-- <div class="s009">
        <form action="{{ route('searchPorto') }}" method="POST">
            @csrf
            <div class="inner-form">
                <div class="basic-search">
                    <div class="input-field">
                        <input id="search" type="text" name="name" placeholder="Type Keywords" />
                        <div class="icon-wrap">
                            <svg class="svg-inline--fa fa-search fa-w-16" fill="#ccc" aria-hidden="true"
                                data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="advance-search">
            <span class="desc">ADVANCED SEARCH</span>
            <div class="row">
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Accessories</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Color</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Size</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row second">
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Sale</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Time</option>
                    <option>Last time</option>
                    <option>Today</option>
                    <option>This week</option>
                    <option>This month</option>
                    <option>This year</option>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Type</option>
                    <option>Subject b</option>
                    <option>Subject c</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row third">
              <div class="input-field">
                <div class="result-count">
                  <span>108 </span>results</div>
                <div class="group-btn">
                  <button class="btn-delete" id="delete">RESET</button>
                  <button type="submit" class="btn-search">SEARCH</button>
                </div>
              </div>
            </div>
          </div>
            </div>
        </form> --}}
    </div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                


                {{-- <form action="{{ route('searchPorto') }}" method="POST">
                        @csrf
                        <input type="text" name="name">
                        <input type="submit" value="Search">
                    </form> --}}
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
                                                            href="{{ route('search.show', $mhs->id) }}">
                                                            <i class="fas fa-info fa-lg" style="color: #00A9E2"></i></a>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('inlinejs')
    <script>
        $(document).ready(function() {
            $('#tabel_mahasiswa').DataTable();
        });

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

    <script src="{{ asset('guest/js/extention/choices.js') }}"></script>
    
    {{-- <script>
        const customSelects = document.querySelectorAll("select");
        const deleteBtn = document.getElementById('delete')
        const choices = new Choices('select', {
            searchEnabled: false,
            itemSelectText: '',
            removeItemButton: true,
        });
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault()
            const deleteAll = document.querySelectorAll('.choices__button')
            for (let i = 0; i < deleteAll.length; i++) {
                deleteAll[i].click();
            }
        });
    </script> --}}
@endsection

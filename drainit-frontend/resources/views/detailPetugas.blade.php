@extends('layout.main')

@section('title', 'Petugas')

@section('head_title', 'Petugas')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <!-- Card header -->
        <div class="card-header bg-transparent d-flex justify-content-between">
          <h3 class="mb-0">Detail Petugas</h3>
          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default">Edit</button>
        </div>
        <div class="card-body">
            <div class="row mx-2">
                <div class="col-md-4">
                  <div class="row">
                      <img src="{{ config('global.base_url') }}{{ $data['foto'] }}" width="200">
                  </div>
                  <div class="row mt-2">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-foto">Ganti Foto</button>
                  </div>
                </div>
                <div class="col-md-5 mx-3">
                    <table cellpadding="9">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $data['nama'] }}</td>
                        </tr>
                        <tr>
                            <td>posisi_petugas</td>
                            <td>:</td>
                            <td>{{ $data['posisi_petugas'] }}</td>
                        </tr>
                        <tr>
                            <td>no_hp</td>
                            <td>:</td>
                            <td>{{ $data['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>:</td>
                            <td>{{ $data['email'] }}</td>
                        </tr>
                        <tr>
                            <td>TTL</td>
                            <td>:</td>
                            <td> {{ $data['tempat_lahir'] }},  {{ $data['tgl_lahir'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
 
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Edit Data Petugas</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('petugas/update/' . $data['id'])  }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                        </div>
                        <input class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Petugas" type="text" value="{{ $data['nama'] }}" name="nama">
                        @error('nama')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" type="email" value="{{ $data['email'] }}" name="email">
                        @error('email')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                        </div>
                        <input class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Petugas" type="text" value="{{ $data['alamat'] }}" name="alamat">
                        @error('alamat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                        </div>
                        <input class="form-control @error('posisi_petugas') is-invalid @enderror" placeholder="Posisi" type="text" value="{{ $data['posisi_petugas'] }}" name="posisi_petugas">
                        @error('posisi_petugas')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                        </div>
                        <input class="form-control @error('no_hp') is-invalid @enderror" placeholder="No Hp" type="text" value="{{ $data['no_hp'] }}" name="no_hp">
                        @error('no_hp')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-map-big"></i></span>
                        </div>
                        <input class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" type="text" value="{{ $data['tempat_lahir'] }}" name="tempat_lahir">
                        @error('tempat_lahir')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control @error('tgl_lahir') is-invalid @enderror" type="date" id="example-date-input" value="{{ $data['tgl_lahir'] }}" name="tgl_lahir">
                        @error('tgl_lahir')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="col-md-12">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Kirim</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal update foto -->
<div class="modal fade" id="modal-edit-foto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
      </div>
      <div class="modal-body">
         <form action="{{ url('petugas/updateFoto/' . $data['id'])  }}" method="post" role="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <img class="mx-auto d-block" src="{{ config('global.base_url') }}{{ $data['foto'] }}" width="200">
            </div>
            <div class="row mt-3">
            <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-image"></i></span>
                        </div>
                        <input type="hidden" value="{{ $data['email'] }}" name="email">
                        <input type="hidden" value="{{ $data['nama'] }}" name="nama">
                        <input type="hidden" value="{{ $data['no_hp'] }}" name="no_hp">
                        <input type="hidden" value="{{ $data['posisi_petugas'] }}" name="posisi_petugas">
                        <input type="hidden" value="{{ $data['tempat_lahir'] }}" name="tempat_lahir">
                        <input type="hidden" value="{{ $data['tgl_lahir'] }}" name="tgl_lahir">
                        <input type="hidden" value="{{ $data['alamat'] }}" name="alamat">
                        <input class="form-control @error('foto') is-invalid @enderror" placeholder="Foto Titik Banjir" type="file" multiple value="{{ old('foto') }}" name="foto">
                        @error('foto')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>
  @endsection

  @push('scripts')
    <script>
      @if ($errors->any())
        $(window).on('load', () => {
          $('#modal-default').modal('show');
        });
      @endif
    </script>
  @endpush

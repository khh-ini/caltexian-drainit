@extends('layout.main')

@section('title', 'Titik Banjir')

@section('head_title', 'Titik Banjir')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Tabel Titik Banjir</h3>
          <Button class="btn btn-primary mt-3" data-toggle="modal" data-target="#modal-default">Tambah data</Button>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col" class="sort" data-sort="name">Nama Jalan</th>
                <th scope="col" class="sort" data-sort="status">Kondisi Kerukan</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              <?php $no = 0; ?>
              @foreach($data as $item)
              <?php $no++; ?>
              <tr>
                <th scope="row">

                  <div class="media align-items-center">
                    <div class="media-body">

                      <span class="name mb-0 text-sm">{{ $no }}</span>
                    </div>
                  </div>
                </th>
                <th scope="row">
                  <div class="media align-items-center">
                    <!-- <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                                        </a> -->
                    <div class="media-body">
                      <span class="name mb-0 text-sm">{{$item['nama_jalan']}}</span>
                    </div>
                  </div>
                </th>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-warning"></i>
                    <span class="status">{{$item['kondisi_kerusakan']}}</span>
                  </span>
                </td>

                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{ url('banjir/detail/' . $item['id']) }}">Detail</a>
                      <a class="dropdown-item" href="{{ url('banjir/' . $item['id']) }}">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- form modal input data dibawah -->
  <div class="row">
    <div class="col-md-4">
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Tambah Data Titik Banjir</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <div class="modal-body">

              <form role="form" action="/banjir/addBanjir" method="post" enctype="multipart/form-data" role="form">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-map-big"></i></span>
                        </div>
                        <input class="form-control" placeholder="Nama Jalan" type="text" name="nama_jalan">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                        </div>
                        <input class="form-control" placeholder="Geometry" type="text" name="geometry">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-world"></i></span>
                        </div>
                        <input class="form-control" placeholder="Kondisi Kerukan" type="text" name="kondisi">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-image"></i></span>
                        </div>
                        <input class="form-control" placeholder="Foto Titik Banjir" type="file" name="foto" multiple>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Deskripsi</label>
                      <div class="input-group input-group-merge input-group-alternative">

                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                        </div>

                        <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3"></textarea>
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
  </div>
</div>
@endsection
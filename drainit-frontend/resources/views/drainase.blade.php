@extends('layout.main')

@section('styles')

<style>
  #map {
    width: 100%;
    height: 600px;
  }
</style>

@endsection

@section('title', 'Jaringan Drainase')

@section('head_title', 'Jaringan Drainase')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Tabel Jaringan Drainase</h3>
          <Button class="btn btn-primary mt-3" data-toggle="modal" data-target="#modal-default">Tambah data</Button>
          </button>

        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Jalan</th>
                <th scope="col">Ukuran</th>
                <th scope="col">Tipe</th>
                <th scope="col">Kondisi</th>
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
                    <div class="media-body">
                      <span class="name mb-0 text-sm">{{$item['nama_jalan']}}</span>
                    </div>
                  </div>
                </th>
                <td class="budget">
                  <span class="badge badge-dot mr-4">
                    <i class="bg-warning"></i>
                    <span class="status">{{$item['lebar']}} x {{$item['panjang']}}</span>
                  </span>
                </td>
                <td>
                  {{$item['tipe_drainase']}}
                </td>

                <td>
                  {{$item['kondisi']}}
                </td>

                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{ url('drainase/detail/' . $item['id']) }}">Detail</a>
                      <a class="dropdown-item" href="{{ url('drainase/' . $item['id']) }}">Hapus</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Card footer -->
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <!-- form modal input data dibawah -->
  <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-default">Tambah Data Drainase</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <form action="/drainase/addDrainase" method="post" enctype="multipart/form-data" role="form">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control @error('nama_jalan') is-invalid  @enderror" value="{{ @old('nama_jalan') }}" placeholder="Nama Jalan" name="nama_jalan" type="text">
                    @error('nama_jalan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                    <input name="geometry" id="geometry" type="hidden">
                    @error('geometry')
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
                      <span class="input-group-text"><i class="ni ni-ungroup"></i></span>
                    </div>
                    <input class="form-control @error('lebar') is-invalid  @enderror" value="{{ @old('lebar') }}" placeholder="Lebar" name="lebar" type="text">
                    @error('lebar')
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
                      <span class="input-group-text"><i class="ni ni-ui-04"></i></span>
                    </div>
                    <input class="form-control @error('panjang') is-invalid  @enderror" value="{{ @old('panjang') }}" placeholder="Panjang" name="panjang" type="text">
                    @error('panjang')
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
                      <span class="input-group-text"><i class="ni ni-ungroup"></i></span>
                    </div>
                    <input class="form-control @error('kedalaman') is-invalid  @enderror" value="{{ @old('kedalaman') }}" placeholder="Kedalaman" name="kedalaman" type="text">
                    @error('kedalaman')
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
                      <span class="input-group-text"><i class="ni ni-ui-04"></i></span>
                    </div>
                    <input class="form-control @error('bahan') is-invalid  @enderror" value="{{ @old('bahan') }}" placeholder="Bahan" name="bahan" type="text">
                    @error('bahan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-image"></i></span>
                    </div>
                    <input class="form-control @error('foto') is-invalid  @enderror" value="{{ @old('foto') }}" placeholder="Foto Titik Banjir" name="foto" type="file" multiple>
                    @error('foto')
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
                      <span class="input-group-text"><i class="ni ni-ungroup"></i></span>
                    </div>
                    <input class="form-control @error('akhir_pembuangan') is-invalid  @enderror" value="{{ @old('akhir_pembuangan') }}" placeholder="Akhir Pembuangan" name="akhir_pembuangan" type="text">
                    @error('akhir_pembuangan')
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
                      <span class="input-group-text"><i class="ni ni-ui-04"></i></span>
                    </div>
                    <input class="form-control @error('arah_alir') is-invalid  @enderror" value="{{ @old('arah_alir') }}" placeholder="Arah Alir" name="arah_alir" type="text">
                    @error('arah_alir')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input id="tipe" type="hidden" name="tipe_name" value="tipe_drainase">
                  <select name="tipe_drainase" id="tipe-drainase" class="form-control">
                    <option>Tipe Drainase</option>
                    @foreach ( $kategori as $k )
                    <option value="{{ $k['kategori'] }}">{{ $k['kategori'] }}</option>
                    @endforeach
                  </select>
                  {{-- <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-ui-04"></i></span>
                        </div>
                        <input class="form-control @error('tipe_drainase') is-invalid  @enderror" value="{{ @old('tipe_drainase') }}" placeholder="Tipe Drainase" name="tipe_drainase" type="text">
                  @error('tipe_drainase')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div> --}}
              </div>
            </div>
            <div class="col-md-12">
              <label class="form-label">Tipe Baru</label>
              <input type="text" class="form-control" id="tipe-baru" name="tipe-baru" placeholder="tipe baru" disabled>
            </div>
            <div class="col-md-12 mt-1">
              <button type="button" id="btn-tipe" class="btn btn-sm btn-primary">Tambah</button>
            </div>
            <div class="col-md-12 mt-3">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Kondisi</label>
                <div class="input-group input-group-merge input-group-alternative">

                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                  </div>

                  <textarea class="form-control @error('kondisi') is-invalid  @enderror" id="exampleFormControlTextarea1" name="kondisi" rows="3">{{ old('kondisi') }}</textarea>
                  @error('kondisi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <a class="btn btn-warning mt-3 text-white" data-toggle="modal" data-target="#modalMaps">Geometry</a>
            </div>
            <div class="col-md-3 offset-6">
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

<!-- modal peta -->
<div class="modal fade" id="modalMaps">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Koordinat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="hapus">Reset</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  @if($errors -> any())
  $(window).on('load', () => {
    $('#modal-default').modal('show');
  });
  @endif

  let mymap = null;
  let accessToken = 'pk.eyJ1Ijoicml3YWxzeWFtIiwiYSI6ImNrajB5c21obTF1ZmQycnAyOTY3N2VycXUifQ.DAfn6MTxzf_BU3lqD0fIgQ'

  const init = async () => {

    let tileLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: 'mapbox/streets-v11',
      maxZoom: 18,
      tileSize: 512,
      zoomOffset: -1,
      accessToken: accessToken
    });

    mymap = L.map('map', {
      layers: [
        tileLayer,
      ]
    }).setView([0.5359175, 101.4382695], 13);

    let line = [];
    let geoLine = [];
    let polyline = null;

    mymap.addEventListener('click', (e) => {
      const coord = [e.latlng.lat, e.latlng.lng];
      const geoCoord = [e.latlng.lng, e.latlng.lat];
      line.push(coord);
      geoLine.push(geoCoord);
      L.marker(coord).addTo(mymap);
      polyline = L.polyline(line, {
        color: "black",
        width: 10
      }).addTo(mymap);

      let lines = {
        "type": "LineString",
        "coordinates": geoLine
      }

      $('#geometry').val(JSON.stringify(lines));


    });

    $('#hapus').on('click', function() {
      mymap.eachLayer(function(layer) {
        if (!!layer.toGeoJSON) {
          mymap.removeLayer(layer);
          line = [];
        }
      });
    });

    $('#modalMaps').on('shown.bs.modal', function() {
      setTimeout(function() {
        mymap.invalidateSize();
      }, 1);
    });

    $('#btn-tipe').on('click', function() {
      $('#tipe').val("tipe-baru");
      $('#tipe-baru').prop('disabled', false);
      $('#tipe-drainase').prop('disabled', true);
      $(this).prop('disabled', true);
    })
  }

  init();
</script>

@endpush
@extends('layout.main')

@section('styles')

  <style>
        #map {
            width: 650px;
            height: 595px;
        }
        #mapUpdate {
            width: 100%;
            height: 600px;
        }
  </style>

@endsection

@section('title', 'Detail Drainase')

@section('head_title', 'Jaringan Drainase')

@section('content')

    <!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
        <div class="col-xl-5">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col d-flex justify-content-between">
                  <h5 class="h3 mb-0">{{ $item['nama_jalan'] }}</h5>
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default">Edit</button>
                </div>
              </div>
            </div>
            <div class="card-body">
                <table class="table align-items-center table-flush">
                    <tr>
                        <td colspan="2" class="text-center">
                            <img src="{{ config('global.base_url') }}{{ $item['foto'] }}" width="200">
                            <br>
                            <button class="btn btn-primary btn-sm mt-3" data-toggle="modal" data-target="#modal-edit-foto">Ganti Foto</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Jalan</td>
                        <td>{{ $item['nama_jalan'] }}</td>
                    </tr>
                    <tr>
                        <td>ukuran</td>
                        <td> {{ $item['panjang'] }} x {{ $item['lebar'] }}</td>
                    </tr>
                    <tr>
                        <td>kedalaman</td>
                        <td>{{ $item['kedalaman'] }}</td>
                    </tr>
                    <tr>
                        <td>bahan</td>
                        <td>{{ $item['bahan'] }}</td>
                    </tr>
                    <tr>
                        <td>kondisi</td>
                        <td>{{ $item['kondisi'] }}</td>
                    </tr>
                    <tr>
                        <td>akhir pembuangan</td>
                        <td>{{ $item['akhir_pembuangan'] }}</td>
                    </tr>
                    <tr>
                        <td>arah alir</td>
                        <td>{{ $item['arah_alir'] }}</td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
        <div class="col-xl-7">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">view</h6>
                  <h5 class="h3 mb-0">titik peta</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div id="map"></div>
            </div>
          </div>
          </div>
  </div>

   <!-- form edit drainase -->
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Edit Data Drainase</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="{{ url('drainase/update/' . $item['id']) }}" method="post" enctype="multipart/form-data" role="form">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                        </div>
                        <input class="form-control @error('nama_jalan') is-invalid  @enderror" value="{{ $item['nama_jalan'] }}" placeholder="Nama Jalan" name="nama_jalan" type="text">
                        @error('nama_jalan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        <input name="geometry" id="geometry" type="hidden">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-ungroup"></i></span>
                        </div>
                        <input class="form-control @error('lebar') is-invalid  @enderror" value="{{ $item['lebar'] }}" placeholder="Lebar" name="lebar" type="text">
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
                        <input class="form-control @error('panjang') is-invalid  @enderror" value="{{ $item['panjang'] }}" placeholder="Panjang" name="panjang" type="text">
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
                        <input class="form-control @error('kedalaman') is-invalid  @enderror" value="{{ $item['kedalaman'] }}" placeholder="Kedalaman" name="kedalaman" type="text">
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
                        <input class="form-control @error('bahan') is-invalid  @enderror" value="{{ $item['bahan'] }}" placeholder="Bahan" name="bahan" type="text">
                         @error('bahan')
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
                        <input class="form-control @error('akhir_pembuangan') is-invalid  @enderror" value="{{ $item['akhir_pembuangan'] }}" placeholder="Akhir Pembuangan" name="akhir_pembuangan" type="text">
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
                        <input class="form-control @error('arah_alir') is-invalid  @enderror" value="{{ $item['arah_alir'] }}" placeholder="Arah Alir" name="arah_alir" type="text">
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
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-ui-04"></i></span>
                        </div>
                        <input class="form-control @error('tipe_drainase') is-invalid  @enderror" value="{{ $item['tipe_drainase'] }}" placeholder="Tipe Drainase" name="tipe_drainase" type="text">
                         @error('tipe_drainase')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Kondisi</label>
                      <div class="input-group input-group-merge input-group-alternative">

                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                        </div>

                        <textarea class="form-control @error('kondisi') is-invalid  @enderror" id="exampleFormControlTextarea1" name="kondisi" rows="3">{{$item['kondisi'] }}</textarea>
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

<!-- Geometry Input -->
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
        <div id="mapUpdate"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="hapus">Reset</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
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
         <form action="{{ url('drainase/updateFoto/' . $item['id'])  }}" method="post" role="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <img class="mx-auto d-block" src="{{ config('global.base_url') }}{{ $item['foto'] }}" width="200">
            </div>
            <div class="row mt-3">
            <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-image"></i></span>
                        </div>
                        <input type="hidden" value="{{ $item['nama_jalan'] }}" name="nama_jalan">
                        <input type="hidden" value="{{ $item['lebar'] }}" name="lebar">
                        <input type="hidden" value="{{ $item['panjang'] }}" name="panjang">
                        <input type="hidden" value="{{ $item['kedalaman'] }}" name="kedalaman">
                        <input type="hidden" value="{{ $item['bahan'] }}" name="bahan">
                        <input type="hidden" value="{{ $item['kondisi'] }}" name="kondisi">
                        <input type="hidden" value="{{ $item['akhir_pembuangan'] }}" name="akhir_pembuangan">
                        <input type="hidden" value="{{ $item['arah_alir'] }}" name="arah_alir">
                        <input type="hidden" value="{{ $item['tipe_drainase'] }}" name="tipe_drainase">
                        <input type="hidden" value="{{ $item['geometry'] }}" name="geometry">
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

    let mymap = null;
    let mapUpdate = null;
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

        let tileLayer1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            maxZoom: 18,
            tileSize: 512,
            zoomOffset: -1,
            accessToken: accessToken
        });

        let polyline = <?= $data ?>;
        let point = polyline.geometry.coordinates;

        // console.log(polyline);

        let geostatic = L.geoJson(polyline);

        mymap = L.map('map', {
            layers: [
                tileLayer,
                geostatic
            ]
        }).setView([polyline.view[1], polyline.view[0]], 17);

  // MAP UPDATE
        let geo = L.geoJson(polyline)
        mapUpdate = L.map('mapUpdate', {
            layers: [
                tileLayer1,
                geo
            ]
        }).setView([polyline.view[1], polyline.view[0]], 17);

        let line = [];
        let geoLine = [];

        mapUpdate.addEventListener('click', (e) => {
          mapUpdate.removeLayer(geo);
          const coord = [e.latlng.lat, e.latlng.lng];
          const geoCoord = [e.latlng.lng, e.latlng.lat];
          line.push(coord);
          geoLine.push(geoCoord);
          L.marker(coord).addTo(mapUpdate);
          L.polyline(line, {
            color: "black",
            width: 10
          }).addTo(mapUpdate);
          
          let lines = {
            "type": "LineString",
            "coordinates" : 
              geoLine
          }

          //console.log(JSON.stringify(lines));

          $('#geometry').val(JSON.stringify(lines));

        });

        $('#modalMaps').on('shown.bs.modal', function(){
          setTimeout(function() {
            mapUpdate.invalidateSize();
          }, 1);
        });

        $('#hapus').on('click', function() {
              mapUpdate.eachLayer(function (layer) {
                  if (!!layer.toGeoJSON) {
                    mapUpdate.removeLayer(layer);
                    line = [];
                  }
              });
        });
        
    }

    init();

  </script>

@endpush


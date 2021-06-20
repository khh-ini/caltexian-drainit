@extends('layout.main')

@section('styles')

  <style>
        #map {
            width: 650px;
            height: 595px;
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
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Jalan</td>
                        <td>{{ $item['nama_jalan'] }}</td>
                    </tr>
                    <tr>
                        <td>Kondisi_kerusakan</td>
                        <td> {{ $item['kondisi_kerusakan'] }}</td>
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

   <!-- form modal edit banjir -->
  <div class="row">
    <div class="col-md-4">
      <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Edit Data Titik Banjir</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <div class="modal-body">

              <form role="form" action="{{ url('banjir/update/' . $item['id'] ) }}" method="post" enctype="multipart/form-data" role="form">
              @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-map-big"></i></span>
                        </div>
                        <input class="form-control" placeholder="Nama Jalan" value="{{ $item['nama_jalan'] }}" type="text" name="nama_jalan">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                        </div>
                        <input class="form-control" placeholder="Geometry" value="{{ $item['geometry'] }}" type="text" name="geometry">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-world"></i></span>
                        </div>
                        <input class="form-control" placeholder="Kondisi Kerukan" value="{{ $item['kondisi_kerusakan'] }}" type="text" name="kondisi">
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

                        <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3">{{ $item['keterangan'] }}</textarea>
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

@push('scripts')
  <script>
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

        let point = <?= $data ?>;

        // {{-- console.log(point.view); --}}

        let geostatic = L.geoJson(point);

        mymap = L.map('map', {
            layers: [
                tileLayer,
                geostatic
            ]
        }).setView([point.view[1], point.view[0]], 17);
    }

    const geojsonFeature = {
        "type": "Feature",
        "properties": {
            "name": "Coors Field",
            "amenity": "Baseball Stadium",
            "popupContent": "This is where the Rockies play!"
        },
        "geometry": {
            "type": "Point",
            "coordinates": [0.510440, 101.438309]
        }
    };

    init();

</script>
@endpush

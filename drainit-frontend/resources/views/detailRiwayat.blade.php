@extends('layout.main')

@section('styles')

<style>
    #map {
        width: 650px;
        height: 595px;
    }
</style>

@endsection

@section('title', 'Detail Riwayat Diverifikasi')

@section('head_title', 'Detail Riwayat Diverifikasi')

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

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center table-flush">
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="{{ config('global.base_url') }}{{ $item['foto'] }}" width="330" height="460">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Jalan</td>
                            <td>{{ $item['nama_jalan'] }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi Pengaduan</td>
                            <td>{{ $item['deskripsi_pengaduan'] }}</td>
                        </tr>
                        <tr>
                            <td>Status Pengaduan</td>
                            <td><button class="btn btn-success disabled">{{$item['status_pengaduan']}}</button></td>
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

      
        mymap = L.map('map').setView([point.view[0], point.view[1]], 17);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            maxZoom: 18,
            tileSize: 512,
            zoomOffset: -1,
            accessToken: accessToken
        }).addTo(mymap);

        L.marker(point.view).addTo(mymap)
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
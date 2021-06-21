<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrainIT</title>
    <script src="{{ asset("vendor//leafletjs/leaflet.js") }}"></script>
    <link rel="stylesheet" href="{{ asset("css/maps.css") }}" />
    <link rel="stylesheet" href="{{ asset("vendor/leafletjs/leaflet.css") }}" />
    <link rel="stylesheet" href="{{ asset("vendor/cluster/dist/MarkerCluster.css") }}" />
    <link rel="stylesheet" href="{{ asset("vendor/cluster/dist/MarkerCluster.Default.css") }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <header id="header" class="bg-warning">
        <div class="hero">
            <h2>DrainIT</h2>
        </div>
        <div id="chooseObj">
            <button id="dr">Drainase</button>
            <button id="bj">Banjir</button>
            <button id="tt">Titik Tersumbat</button>
            <button onclick="window.location.href='/petugas'">Kembali</button>
        </div>
    </header>
    <section id="content">
        <div id="map"></div>
        <button id="info-btn">
            <h4>Info</h4>
        </button>
        <button id="filter-open">
            <h4>Filter</h4>
        </button>
        <div id="info">
            <div id="info-header" class="bg-warning">
                <h3>Informasi</h3>
                <button id="close-info">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div id="info-body">
                <h3>Belum ada informasi yang diklik</h3>
            </div>
        </div>
        <div id="filter">
            <div id="filter-header">
                <h4 id="filter-title"></h4>
                <button id="close-filter">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <hr />
            <div id="filter-body">
                <input type="text" id="filter-name" />
            </div>
            <span id="no-filter" style="display: none"></span>
            <button id="filter-btn">Filter</button>
        </div>
    </section>
</body>
<script src="{{ asset("vendor/cluster/dist/leaflet.markercluster-src.js") }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset("js/map.js") }}"></script>
</html>
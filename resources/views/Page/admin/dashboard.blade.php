@extends('Page.master')
@section('content')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

  <style>
  .map {
      height: 75vh;
      width: 100%;
  }
</style>

<a> Selamat Datang {{Session::has('nama') ? Session::get('nama') : "dika"}}<a>
<div class="row mt-3">
    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-bloody">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">Total Villa</p>
            <h4 class="text-white line-height-5">{{$villa}}</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-cart-plus text-white"></i></div>
        </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6 col-xl-3">
        <div class="card gradient-blooker">
          <div class="card-body">
            <div class="media align-items-center">
            <div class="media-body">
              <p class="text-white">Total Pemilik</p>
              <h4 class="text-white line-height-5">{{($pemilik)}}</h4>
            </div>
            <div class="w-circle-icon rounded-circle border border-white">
              <i class="fa fa-users text-white"></i></div>
          </div>
          </div>
        </div>
      </div>

    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-scooter">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">Total Fasilitas</p>
            <h4 class="text-white line-height-5">{{($fasilitas)}}</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-money text-white"></i></div>
        </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-ohhappiness">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">Total Tempat Wisata</p>
            <h4 class="text-white line-height-5">{{($wisata)}}</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
    </div>
  </div><!--End Row-->



  <div class="col-lg-12">
      <div class="card">
          <div class="card-header text-uppercase">Maps</div>
          <div class="card-body">
            <div id="map" class="map"></div>
          </div>
      </div>
  </div>

{{-- <div id="map" class="map"></div> --}}
<script type="text/javascript">
    var CurrentPosition = "";
    var maps = "";
    var zoom = 14;

    $(document).ready(() => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                CurrentPosition = {
                    long: position.coords.longitude,
                    lat: position.coords.latitude
                };
                drawMaps();
            });
        } else {
            alert("Browser Not Support");
        }
    });

    function drawMaps() {
        maps = L.map('map').setView([CurrentPosition.lat, CurrentPosition.long], zoom);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Made With me',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(maps);

        L.marker([CurrentPosition.lat, CurrentPosition.long])
            .bindPopup("Lokasi Saya")
            .on('click', (e) => {
                console.log(e);
            })
            .addTo(maps);
        L.circle([CurrentPosition.lat, CurrentPosition.long], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.1,
                radius: 2000
            })
            .bindPopup(`<h1>asasasas</h1>
<ul>
    <li>asasdasd</li>
    <li>asd</li>
    <li>asdzf</li>
    <li>werwyetwer</li>
</ul>`)
            .addTo(maps);
        maps.on('click', (e) => {
            L.popup()
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(maps);
        });
    }
</script>
@endsection

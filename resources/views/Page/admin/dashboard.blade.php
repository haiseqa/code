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

<div class="row">
    <div class="col-12 col-lg-6 col-xl-4">
      <div class="card">
        <div class="card-body">
        <div class="media align-items-center">
         <div class="media-body text-left">
           <p class="mb-0">ORDERS</p>
          <h4 class="text-primary">8052</h4>
         </div>
         <div id="widget-chart-1"></div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-4">
      <div class="card">
        <div class="card-body">
        <div class="media align-items-center">
         <div class="media-body text-left">
           <p class="mb-0">REVENUE</p>
          <h4 class="text-success">$452</h4>
         </div>
         <div id="widget-chart-2"></div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-4">
      <div class="card">
        <div class="card-body">
        <div class="media align-items-center">
         <div class="media-body text-left">
           <p class="mb-0">EXPENSE</p>
          <h4 class="text-secondary">8052</h4>
         </div>
         <div id="widget-chart-3"></div>
        </div>
        </div>
      </div>
    </div>
  </div><!--End row-->

  <div class="col-lg-12">
      <div class="card">
          <div class="card-header text-uppercase">Simple Basic Map</div>
          <div class="card-body">
            <div id="map" class="map"></div>
          </div>
      </div>
  </div>

<div id="map" class="map"></div>
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

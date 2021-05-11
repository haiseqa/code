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

{{-- <div class="row mt-3">
    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-bloody">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">Total Orders</p>
            <h4 class="text-white line-height-5">8450</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-cart-plus text-white"></i></div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-scooter">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">Total Revenue</p>
            <h4 class="text-white line-height-5">$750</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-money text-white"></i></div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-blooker">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">New Users</p>
            <h4 class="text-white line-height-5">620</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-users text-white"></i></div>
        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-ohhappiness">
        <div class="card-body">
          <div class="media align-items-center">
          <div class="media-body">
            <p class="text-white">Bounce Rate</p>
            <h4 class="text-white line-height-5">12.80%</h4>
          </div>
          <div class="w-circle-icon rounded-circle border border-white">
            <i class="fa fa-pie-chart text-white"></i></div>
        </div>
        </div>
      </div>
    </div>
  </div><!--End Row--> --}}

  {{-- <div class="col-lg-12">
      <div class="card">
          <div class="card-header text-uppercase">Simple Basic Map</div>
          <div class="card-body">
            <div id="map" class="map"></div>
          </div>
      </div>
  </div> --}}

  <div class="row">
    <div class="col-12 col-lg-12 col-xl-12">
      <div class="card">
           <div class="card-header">
            <i class="fa fa-line-chart"></i> Booking
                <div class="card-action">

          <div class="form-group mb-0">
            <select class="form-control form-control-sm">
              <option>Jan 18</option>
              <option>Feb 18</option>
              <option>Mar 18</option>
              <option>Apr 18</option>
              <option>May 18</option>
              <option>Jun 18</option>
              <option>Jul 18</option>
              <option>Aug 18</option>
              <option selected>Sept 18</option>
            </select>
          </div>
                 </div>
                </div>
             <div class="card-body">
               <canvas id="chart_dashboard" height="100"></canvas>
             </div>
      </div>
    </div>

  </div><!--End Row-->

{{-- <div id="map" class="map"></div> --}}
{{-- <script type="text/javascript">
    var CurrentPosition = "";
    var maps = "";
    var zoom = 14;

    $(document).ready(() => {
        CurrentPosition = {
            long: "{{$villa->longitude}}",
            lat: "{{$villa->latitude}}"
        };
        drawMaps();
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
                opacity: 0,
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
</script> --}}

<script>
    var ctx = document.getElementById('chart_dashboard').getContext('2d');
    var chart = "";
    var data_chart_villa = $.parseJSON(@json($data_chart));
    var villa = [];
    $(document).ready(function () {
        // console.log(data_chart);
        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke1.addColorStop(0, '#4facfe');
        gradientStroke1.addColorStop(1, '#00f2fe');
        $.each(data_chart_villa, function (index, value) {
            villa[index - 1] = value;
        });
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ],
                datasets: [{
                    label: 'Booking Villa',
                    data: villa,
                    backgroundColor: 'rgba(94, 114, 228, 0.3)',
                    borderColor: '#5e72e4',
                    borderWidth: 3
                }]
            }
        });
    });
</script>


@endsection

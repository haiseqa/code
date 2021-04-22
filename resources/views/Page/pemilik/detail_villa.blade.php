@extends('Page.master')
@section('content')

<link href="{{asset('dashboard/plugins/fancybox/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css"/>
<script src="{{asset('dashboard/plugins/fancybox/js/jquery.fancybox.min.js')}}"></script>
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
      position: sticky !important;
  }
</style>

<div class="row">
    <div class="col-lg-12">
        <h1>
            <span>
                {!!str_replace("&nbsp;", " ", $villa->nama_villa)!!}
            </span>
        </h1>
        <hr style="border: solid grey 1px;">
    </div>
    <div class="col-lg-6">
        <span>
            {!!str_replace("&nbsp;", " ", $villa->deskripsi)!!}
        </span>
        <span>
            {!!str_replace("&nbsp;", " ", $villa->alamat_villa)!!}
        </span>
        <span>
           Rp {{number_format($villa->harga_villa, 0, ',','.')}}
        </span>
        <p>
            Fasilitas :
        </p>
        <p>
            @foreach ($fasilitas as $item)
            <span class="badge badge-dark shadow-dark m-1">{{$item->nama_fasilitas}}</span>
            @endforeach
        </p>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div id="map" class="map"></div>
                <br>
            </div>
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-12">
                        <div class="card">
                          <div class="card-header text-uppercase">Image Villa</div>
                          <div class="card-body">
                            <div class="row">

                                @foreach ( $image as $item )
                                <div class="col-md-6 col-lg-3 col-xl-3">
                                    <a href="{{asset ($item->path) }}" data-fancybox="group2">
                                    <img src="{{asset ($item->path)}}" alt="lightbox" class="lightbox-thumb img-thumbnail">
                                  </a>
                                  </div>

                                @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                  </div><!--End Row-->
                </div>
                <h1>sasa</h1>
            </div>
        </div>
    </div>
</div>

</div>
<script type="text/javascript">
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
</script>


@endsection

@extends('Page.Pengguna.master')
@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
<style>
    .mySlides {display:none;}
    </style>

<div class="row">
    <div class="col-lg-12">
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header text-uppercase">
                <div class="nav-item">
                    <form class="search-bar">
                      <input type="text" class="form-control" placeholder="Enter keywords">
                       <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                    </form>
                </div>
            </div>
            <div class="card-body">
              <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#piil-1"><i class="icon-home"></i> <span class="hidden-xs">Home</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#piil-2"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:void();"><i class="icon-settings"></i> <span class="hidden-xs">Setting</span></a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" data-toggle="pill" href="#piil-3">Link 1</a>
                    <a class="dropdown-item" href="javascript:void();">Link 2</a>
                    <a class="dropdown-item" href="javascript:void();">Link 3</a>
                    </div>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="w3-content w3-display-container">
                    <img class="mySlides" src="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg" style="width:50%">
                    <img class="mySlides" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1b/4b/5d/10/caption.jpg?w=500&h=300&s=1&cx=1005&cy=690&chk=v1_2ed86f729380ea073850" style="width:50%">
                    <img class="mySlides" src="https://www.rukita.co/stories/wp-content/uploads/2020/03/olimpiade-tokyo-2020.jpg" style="width:50%">
                    <img class="mySlides" src="https://res.cloudinary.com/duu3v9gfg/image/fetch/t_fit_1920/https://78884ca60822a34fb0e6-082b8fd5551e97bc65e327988b444396.ssl.cf3.rackcdn.com/up/2019/08/Mount-Fuji-1565615301-1565615301.jpg" style="width:50%">

                    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                  </div>

                <div id="piil-1" class="container tab-pane active">
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet</p>
                </div>
                <div id="piil-2" class="container tab-pane fade">
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                </div>

                <div id="piil-3" class="container tab-pane fade">
                  <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                </div>
              </div>
            </div>
         </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-uppercase">Simple Basic Map</div>
                    <div class="card-body">
                <div id="map" class="map"></div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-lg-12">

                <div class="row">

                    {{-- <div class="col-12">
                        <div class="card">
                          <div class="card-header text-uppercase">Image Villa</div>
                          <div class="card-body">
                            <div class="row">

                                {{-- @foreach ( $image as $item )
                                <div class="col-md-6 col-lg-3 col-xl-3">
                                    <a href="{{asset ($item->path) }}" data-fancybox="group2">
                                    <img src="{{asset ($item->path)}}" alt="lightbox" class="lightbox-thumb img-thumbnail">
                                  </a>
                                  </div>

                                @endforeach --}}
                            {{-- </div>
                          </div>
                        </div>
                      </div>  --}}

                  </div><!--End Row-->
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }
    </script>
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

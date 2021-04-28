@extends('Page.Pengguna.master')
@section('content')
<link href="{{asset('dashboard/plugins/fancybox/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('dashboard/plugins/fancybox/js/jquery.fancybox.min.js')}}"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />

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
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <form class="float-lg-end">
                    <div class="row row-cols-lg-auto g-2">
                        <div class="col-6">
                            <div class="position-relative">
                                <input type="text" class="form-control ps-5" placeholder="Search Product...">
                                <span class="position-absolute top-50 product-show translate-middle-y">
                                    <i class="search-bar"></i>
                                </span>
                            </div>
                        </div>
                        {{-- <div class="col-6"> --}}
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" class="btn btn-white">Sort By</button>
                                <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-chevron-down"></i>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                                    <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                    <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                  </ul>
                                </div>
                              </div>
                        {{-- </div> --}}
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-white">Sort By</button>
                            <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-chevron-down"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin: 0px;">
                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                              </ul>
                            </div>
                          </div>

                    </div>
                </form>
            </div>
            {{-- <div class="card-body">
                <div class="tab-content">
                    <div id="piil-1" class="container tab-pane active">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div id="piil-1" class="container tab-pane active">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <img class="d-block w-100" src="dashboard/images/gallery/slider-4.jpg" alt="First slide">
                                                              </div>
                                                              <div class="carousel-item">
                                                                <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                              </div>
                                                              <div class="carousel-item">
                                                                <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                              </div>
                                                              <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                              </a>
                                                              <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                              </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <span>Nama Villa</span>
                                                    <br>
                                                    <span>Rp 1000.000</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="piil-1" class="container tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-4.jpg" alt="First slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
                                                  <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Nama Villa</span>
                                        <br>
                                        <span>Rp 1000.000</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="piil-1" class="container tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="carousel-3" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-4.jpg" alt="First slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <a class="carousel-control-prev" href="#carousel-3" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
                                                  <a class="carousel-control-next" href="#carousel-3" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Nama Villa</span>
                                        <br>
                                        <span>Rp 1000.000</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="piil-1" class="container tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-4.jpg" alt="First slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
                                                  <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Nama Villa</span>
                                        <br>
                                        <span>Rp 1000.000</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="piil-1" class="container tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-4.jpg" alt="First slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <div class="carousel-item">
                                                    <img class="d-block w-100" src="dashboard/images/gallery/slider-5.jpg" alt="Second slide">
                                                  </div>
                                                  <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
                                                  <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Nama Villa</span>
                                        <br>
                                        <span>Rp 1000.000</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
           {{-- <div class="card-header text-uppercase">Simple Basic Map</div> --}}
            <div class="card-body">
              <div id="map" class="map">

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

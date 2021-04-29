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
                    <div class="row row-cols-lg-auto g-2 ">
                        <div class="col-6">
                            <div class="position-relative">
                                <input type="text" class="form-control ps-5" placeholder="Search Villa...">
                                {{-- <span class="position-absolute top-50 product-show translate-middle-y"> --}}
                                    {{-- <i class="search-bar"></i> --}}
                                </span>
                            </div>
                        </div>
                        {{-- <div class="col-6"> --}}
                            <div class="btn-group m-1" role="group">
                                <button type="button" class="btn btn-light  waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Harga
                                </button>
                                <div class="dropdown-menu">
                                  <a href="javaScript:void();" class="dropdown-item">Harga 1</a>
                                  <a href="javaScript:void();" class="dropdown-item">Harga 2</a>
                                  <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                </div>
                              </div>
                        {{-- </div> --}}
                        <div class="btn-group m-1" role="group">
                            <button type="button" class="btn btn-light  waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Objek Wisata
                            </button>
                            <div class="dropdown-menu">
                              <a href="javaScript:void();" class="dropdown-item">Objek Wisata 1</a>
                              <a href="javaScript:void();" class="dropdown-item">Objek Wisata 2</a>
                              <a href="javaScript:void();" class="dropdown-item">Objek Wisata 3</a>
                              <a href="javaScript:void();" class="dropdown-item">Objek Wisata 4</a>
                              <a href="javaScript:void();" class="dropdown-item">Objek Wisata 5</a>
                              <a href="javaScript:void();" class="dropdown-item">Objek Wisata 6</a>
                              <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                              <div class="dropdown-divider"></div>
                            </div>
                          </div>
                          <button type="button" class="btn btn-light waves-effect waves-light m-1" data-toggle="modal" data-target="#formemodal">More</button>
                    </div>
                </form>
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
                                    <div class="col-lg-6">
                                    <button type="button" class="btn btn-outline-info waves-effect waves-light m-1">View deal</button>
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
    <!-- Modal -->
    <div class="modal fade" id="formemodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Filter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                   <div class="form-group">
                    <div class="col-md-3">
                        <div class="icheck-material-primary">
                          <input type="checkbox" id="primary" checked/>
                          <label for="primary">Primary</label>
                        </div>
                       </div>
                       <div class="col-md-3">
                        <div class="icheck-material-success">
                          <input type="checkbox" id="success" checked/>
                          <label for="success">Success</label>
                        </div>
                       </div>
                       <div class="col-md-3">
                        <div class="icheck-material-danger">
                          <input type="checkbox" id="danger" checked/>
                          <label for="danger">Danger</label>
                        </div>
                       </div>
                       <div class="col-md-3">
                        <div class="icheck-material-info">
                          <input type="checkbox" id="info" checked/>
                          <label for="info">Info</label>
                        </div>
                       </div>
                       <div class="col-md-3">
                        <div class="icheck-material-warning">
                          <input type="checkbox" id="warning" checked/>
                          <label for="warning">Warning</label>
                        </div>
                       </div>
                       <div class="col-md-3">
                        <div class="icheck-material-secondary">
                          <input type="checkbox" id="secondary" checked/>
                          <label for="secondary">Secondary</label>
                        </div>
                       </div>
                       <div class="col-md-3">
                        <div class="icheck-material-dark">
                          <input type="checkbox" id="dark" checked/>
                          <label for="dark">Dark</label>
                        </div>
                       </div>
                    </div><!--End Row-->
                     <label for="input-1">Name</label>
                     <input type="text" class="form-control" id="input-1" placeholder="Enter Your Name">
                   </div>
                   <div class="form-group">
                     <label for="input-2">Email</label>
                     <input type="text" class="form-control" id="input-2" placeholder="Enter Your Email Address">
                   </div>
                   <div class="form-group">
                     <label for="input-3">Password</label>
                     <input type="text" class="form-control" id="input-3" placeholder="Enter Password">
                   </div>
                   <div class="form-group">
                     <div class="icheck-material-info">
                     <input type="checkbox" id="user-checkbox1" checked="">
                     <label for="user-checkbox1">Remember me</label>
                    </div>
                   </div>
                   <div class="form-group">
                    <button type="submit" class="btn btn-info shadow-info px-5"><i class="icon-lock"></i> Login</button>
                  </div>
              </form>
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

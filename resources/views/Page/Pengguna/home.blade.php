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
        height: 71vh;
        width: 100%;
        position: sticky !important;
    }

</style>
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <div class="row row-cols-lg-auto g-2 ">
                    <div class="col-6">
                        <div class="position-relative">
                            <input type="text" class="form-control ps-5" id="filter_serach" placeholder="Search Villa...">
                            {{-- <span class="position-absolute top-50 product-show translate-middle-y"> --}}
                            {{-- <i class="search-bar"></i> --}}
                            </span>
                        </div>
                    </div>
                    {{-- <div class="col-6"> --}}
                    {{-- </div> --}}
                    <button type="button" class="btn btn-light waves-effect waves-light m-1" data-toggle="modal"
                        data-target="#filtermodal">All Filter</button>
                </div>
            </div>
            <div class="card-body">
                <div id="content_villa" style="overflow: scroll;overflow-x: hidden;height: 71vh;">

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            {{-- <div class="card-header text-uppercase">Simple Basic Map</div> --}}
            <div class="card-header">
                <h4>Maps</h4>
            </div>
            <div class="card-body">
                <div id="map" class="map">

                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Modal filter -->
    <div class="modal fade" id="filtermodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_search">
                        <div class="form-group">
                            <label for="input-1">Sort By</label>
                            <div class="btn-group m-1" role="group">
                                <select id="filter_harga"
                                    class="form-control input-shadow btn btn-inverse-dark waves-effect waves-light dropdown-toggle">
                                    <option value="desc">Harga Tertinggi</option>
                                    <option value="asc">Harga Terendah</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-3">Sort By</label>
                            <div class="btn-group m-1" role="group">
                                <select id="lokasiwisata"
                                    class="form-control input-shadow btn btn-inverse-dark waves-effect waves-light dropdown-toggle">
                                    <option value="all">Semua</option>
                                    @foreach ($lokasiwisata as $item)
                                    <option value="{{$item->id_lokasi_wisata}}">{{$item->nama_wisata}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-2">Category</label>
                            <div class="row">
                                <script>
                                    var kategori = [];

                                </script>
                                @foreach ($fasilitas as $item)
                                <script>
                                    kategori.push('{{$item->id_fasilitas}}');

                                </script>
                                <div class="col-md-6">
                                    <div class="icheck-material-success">
                                        <input type="checkbox" class="filter_categori" id="{{$item->id_fasilitas}}"
                                            checked />
                                        <label for="{{$item->id_fasilitas}}">{{$item->nama_fasilitas}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info shadow-info px-5"><i class="icon-lock"></i>
                                Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var CurrentPosition = "";
    var maps = "";
    var zoom = 12;
    var data_villa;
    var harga = 'asc';
    var object_wisata = 'all';
    var link_gambar = "{{asset('')}}";
    var link_detail ="{{asset('')}}";
    var radius = "";
    var data_wisata = "";
    var search = 'all';

    $(document).ready(() => {
        get_villa();
        $(".filter_categori").change(function () {
            // console.log(this.checked);
            if (this.checked === true) {
                kategori.push(this.id);
            } else {
                let removeItem = this.id;
                kategori = $.grep(kategori, function (value) {
                    return value !== removeItem;
                });
            }
        });
        $("#filter_serach").change(function(event){
            if(this.value.length > 0){
                search = this.value;
                get_villa();
            }
            else{
                search = 'all';
                get_villa();
            }
        });
        $("#form_search").submit(function (event) {
            event.preventDefault();
            object_wisata = $("#lokasiwisata").val();
            harga = $("#filter_harga").val();
            get_villa();
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                CurrentPosition = {
                    long: 115.5462150131528,
                    lat: -8.731340649191766,
                };
                // drawMaps();
            });
        } else {
            alert("Browser Not Support");
        }
    });

    function get_villa() {
        $.ajax({
            url: "{{route('api.get.villa')}}",
            type: "GET",
            data: {
                "harga": harga,
                "wisata": object_wisata,
                "kategori": kategori,
                "search": search
            },
            success: (data) => {
                //success
                // console.log(data);
                if (data.status === 1) {
                    data_villa = data.data;
                    data_wisata = data.wisata;
                    refresMap()
                    $("#filtermodal").modal('hide');
                    // drawMaps();
                } else {
                    alert_info("Gagal Mengambil Data Villa");
                }
            },
            error: (err) => {
                //error
                alert_error("Gagal Mengambil Data Villa");
            }
        });
    }

    function setData() {
        let layout = "";
        if (object_wisata === 'all') {
            $.each(data_villa, function (index, value) {
                L.marker([value.lat, value.long])
                    .bindPopup(value.nama)
                    .on('click', (e) => {
                        console.log(e);
                    })
                    .addTo(maps);
            });
            $.each(data_villa, function (index, value) {
                layout += `<div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="piil-1" class="container tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="C_${value.id_villa}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                `;
                $.each(value.gambar, function (index1, value1) {
                    if (index1 === 0) {
                        layout += `<div class="carousel-item active">
                                                    <img class="d-block w-100" src="${link_gambar + value1.path}" alt="First slide">
                                                  </div>`;
                    } else {
                        layout += `<div class="carousel-item">
                                                    <img class="d-block w-100" src="${link_gambar + value1.path}" alt="First slide">
                                                  </div>`;
                    }
                });
                layout += `<a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
                                                  <a class="carousel-control-next" href="#C_${value.id_villa}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>${value.nama}</span>
                                        <br>
                                        <i class="zmdi zmdi-pin"></i>
                                        <span>${value.alamat}</span>
                                        <br>
                                        <span>Rp ${value.harga.toLocaleString()}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="${link_gambar + "detail_villa/" + value.id_villa}" style="float: right;"  class="btn btn-outline-info waves-effect waves-light m-1">View deal</a>
                    </div>
                </div>
            </div>`;
            });
            $("#content_villa").html(layout);
        } else {
            // maps.panTo(new L.LatLng(data_wisata.latitude, data_wisata.longitude), 15);
            $.each(data_villa, function (index, value) {
                console.log(data_wisata);
                if(radius.getLatLng().distanceTo([value.lat, value.long]) < radius.getRadius()){
                    L.marker([value.lat, value.long])
                    .bindPopup(value.nama)
                    .on('click', (e) => {
                        console.log(e);
                    })
                    .addTo(maps);
                layout += `<div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="piil-1" class="container tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="C_${value.id_villa}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                `;
                $.each(value.gambar, function (index1, value1) {
                    if (index1 === 0) {
                        layout += `<div class="carousel-item active">
                                                    <img class="d-block w-100" src="${link_gambar + value1.path}" alt="First slide">
                                                  </div>`;
                    } else {
                        layout += `<div class="carousel-item">
                                                    <img class="d-block w-100" src="${link_gambar + value1.path}" alt="First slide">
                                                  </div>`;
                    }
                });
                layout += `<a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
                                                  <a class="carousel-control-next" href="#C_${value.id_villa}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>${value.nama}</span>
                                        <br>
                                        <i class="zmdi zmdi-pin"></i>
                                        <span>${value.alamat}</span>
                                        <br>
                                        <span>Rp ${value.harga.toLocaleString()}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" style="float: right;"  class="btn btn-outline-info waves-effect waves-light m-1">View deal</button>
                    </div>
                </div>
            </div>`;
                }
            });
            $("#content_villa").html(layout);
        }
    }

    function drawMaps() {
        if(object_wisata === 'all'){
            maps = L.map('map').setView([CurrentPosition.lat, CurrentPosition.long], zoom);
        }
        else{
            maps = L.map('map').setView([data_wisata.latitude, data_wisata.longitude], 13);
        }
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Made With me',
            // maxZoom: 12,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(maps);

        if (object_wisata !== 'all') {
            radius = L.circle([data_wisata.latitude, data_wisata.longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0,
                opacity: 0,
                radius: 2000
            }).addTo(maps);
        }

        //set Data
        setData();
    }

    function refresMap() {
        if (maps) {
            maps.eachLayer(function (layer) {
                maps.remove();
                drawMaps();
            });
        } else {
            drawMaps();
        }
    }

</script>
@endsection

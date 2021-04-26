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
                <form class="search-bar">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari" />
                        <div class="input-group-append">
                            <button type="button" style="cursor: pointer" class="input-group-text"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#piil-1"><i class="icon-home"></i> <span
                                class="hidden-xs">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#piil-2"><i class="icon-user"></i> <span
                                class="hidden-xs">Profile</span></a>
                    </li>
                </ul>
                {{-- Konten --}}
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="piil-1" class="container tab-pane active">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look
                            even slightly believable.</p>
                        <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                            embarrassing hidden in the middle of text.All the Lorem Ipsum generators on the Internet
                            tend to repeat predefined chunks as necessary, making this the first true generator on the
                            Internet</p>
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg"
                                    data-fancybox="images" data-caption="This image has a caption">
                                    <img src="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg"
                                        alt="lightbox" class="lightbox-thumb img-thumbnail">
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg"
                                    data-fancybox="images" data-caption="This image has a caption">
                                    <img src="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg"
                                        alt="lightbox" class="lightbox-thumb img-thumbnail">
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg"
                                    data-fancybox="images" data-caption="This image has a caption">
                                    <img src="https://www.worldtravelguide.net/wp-content/uploads/2017/03/shu-Japan-Tokyo-ShibuyaCrossing_666197917-1440x823-1.jpg"
                                        alt="lightbox" class="lightbox-thumb img-thumbnail">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="piil-2" class="container tab-pane fade">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</p>
                        <p>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence
                            structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is
                            therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                    </div>

                    <div id="piil-3" class="container tab-pane fade">
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
                            est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                            numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h4>Maps</h4>
                </div>
                <div class="card-body">
                    <div id="map" class="map"></div>
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

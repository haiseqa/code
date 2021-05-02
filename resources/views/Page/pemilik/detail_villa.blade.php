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
        <h4>
            <span>
                {!!str_replace("&nbsp;", " ", $villa->nama_villa)!!}
            </span>
        </h4>
        <hr style="border: solid grey 1px;">
    </div>
    <div class="col-lg-6">
        <div class="card">
            <br>
        <i class="zmdi zmdi-pin"> {!!str_replace("&nbsp;", " ", $villa->alamat_villa)!!}</i>
        <br>
        <br>
        <span>
            {!!str_replace("&nbsp;", " ", $villa->deskripsi)!!}
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
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-uppercase">
                        <a href="{{route('pemilik.edit_villa')}}" type="submit" class="btn btn-primary">Edit</a>
                        <a href="{{route('pemilik_villa.galeri',[$villa->id_villa])}}" button type="submit" class="btn btn-success">Gambar</button></a>

                    </div>
                    <div class="card-body">
                        <div id="map" class="map">
                        </div>
                    </div>
                </div>
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
            </div>
        </div>
    </div>
</div>


  <!-- Modal Edit -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail villa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post">
                {{ csrf_field() }}
                <input type="text" name="id_villa" id="id_villa_modal" hidden>
                <div class="modal-body">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 15%;">Nama</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="nama_modal" class="form-control" name="nama" value="{{$villa->nama_villa}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Alamat</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="alamat_modal" class="form-control" name="alamat" value="{{$villa->alamat_villa}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Harga</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="number" id="harga_modal" class="form-control" name="harga" value="{{$villa->harga_villa}}">
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 15%;">Fasilitas</td>
                            <td style="width: 1%;">  </td>
                            <td>
                                <div class="row">
                                    @foreach ($fasilitas as $item)
                                    <div class="col-xl-5">
                                        <div class="icheck-material-primary">
                                            <input type="checkbox" name="fasilitas[]" value="{{$item->id_fasilitas}}" id="{{$item->id_fasilitas}}" />
                                            <label for="{{$item->id_fasilitas}}">{{$item->nama_fasilitas}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                            <td style="width: 15%;">About Villa</td>
                            <td style="width: 1%;"> : </td>
                            <td><textarea name="deskripsi" class="form-control" id="deskripsi_modal">{{$villa->deskripsi}}</textarea>
                            </td>
                        </tr>
                        </tr>

                        <tr>
                            <td style="width: 15%;">Latitude</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="lat_modal" class="form-control" name="latitude" value="{{$villa->latitude}}"
                                    placeholder="Latitude" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Longitude</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="long_modal" class="form-control" name="longitude" value="{{$villa->longitude}}"
                                    placeholder="Longitude" required readonly>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-primary" data-dismiss="modal"><i class="fa fa-times"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save changes</button>
                </div>
            </form>
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

    function showEdit(index){
        let tmp_data = $.parseJSON(data_villa);
        console.log(tmp_data[index]);
        ck_edit.setData(tmp_data[index].deskripsi);
        $("#nama_modal").val(tmp_data[index].nama_villa);
        $("#alamat_modal").val(tmp_data[index].alamat_villa);
        $("#harga_modal").val(tmp_data[index].harga_villa);
        $("#deskripsi_modal").html(tmp_data[index].deskripsi);
        $("#lat_modal").val(tmp_data[index].latitude);
        $("#long_modal").val(tmp_data[index].longitude);
        $("#id_villa_modal").val(tmp_data[index].id_villa);
        $("#modalEdit").modal('show');
    }
</script>


@endsection

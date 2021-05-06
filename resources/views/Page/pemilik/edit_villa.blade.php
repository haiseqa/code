@extends('master')

@section('konten')

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Villa</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 15%;">Nama</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="nama" class="form-control" name="nama" value="{{$villa->nama_villa}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Alamat</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="alamat" class="form-control" name="alamat" value="{{$villa->alamat_villa}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Harga</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="number" id="harga" class="form-control" name="harga" value="{{$villa->harga_villa}}">
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
                                                    <input type="checkbox" name="fasilitas[]" value="{{$item->id_fasilitas}}" id="{{$item->id_fasilitas}}" checked />
                                                    <label for="{{$item->id_fasilitas}}">{{$item->nama_fasilitas}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                            @foreach ($fasilitas_data as $item)
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
                                    <td><textarea name="deskripsi_villa" class="form-control" id="deskripsi">{{$villa->deskripsi}}</textarea>
                                    </td>
                                </tr>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">Latitude</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="latitude" class="form-control" name="latitude" value="{{$villa->latitude}}"
                                            placeholder="Latitude" required readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Longitude</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="longitude" class="form-control" name="longitude" value="{{$villa->longitude}}"
                                            placeholder="Longitude" required readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <button style="float: right;" type="submit"
                                            class="btn btn-primary">Edit</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div id="map" style="height: 450px;"></div>
            </div>
        </div>
    </div>
</div>
@include('komponen.ckeditor')

<script type="text/javascript">
    var CurrentPosition = "";
    var maps = "";
    var circle = "";
    var zoom = 14;
    var user_marker = "";
    var ck_edit = "";

    $(document).ready(() => {
        CurrentPosition = {
                    long: "{{$villa->longitude}}",
                    lat: "{{$villa->latitude}}"
                };
                drawMaps();
                ckeditor = CKEDITOR.replace('deskripsi');
    });
    function drawMaps() {
        //nominatim
        maps = L.map('map').setView([CurrentPosition.lat, CurrentPosition.long], zoom);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Made With Me'
        }).addTo(maps);
        L.marker([CurrentPosition.lat, CurrentPosition.long])
                .on('click', (e) => {

                })
                .addTo(maps);


        maps.on('click', (e) => {
            console.log(e);
            getAddress(e.latlng.lat, e.latlng.lng);
            if(user_marker){
                user_marker.setLatLng([e.latlng.lat, e.latlng.lng])
            }
            else{
                user_marker = L.marker([e.latlng.lat, e.latlng.lng])
                .bindPopup("Mark Saya")
                .addTo(maps);
            }
        });
    }

    function getAddress(lat, long) {
        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${long}`, function (data) {
            $("#alamat").val(data.display_name);
            $("#lat").val(lat);
            $("#long").val(long);
        });
    }

</script>
@endsection

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
                                    <td><textarea name="deskripsi" class="form-control" id="deskripsi">{{$villa->deskripsi}}</textarea>
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
                                            class="btn btn-primary">Tambah</button>
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
    var user_marker ="";

    $(document).ready(() => {
        // console.log(data_villa);
        ckeditor = CKEDITOR.replace('deskripsi');
        CurrentPosition = {
            long: "{{$villa->longitude}}",
            lat: "{{$villa->latitude}}"
        };
        drawMaps();

        $("#btnCari").click(function () {
            let keyword = $("#addr").val();
            $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + keyword,
                function (data) {
                    console.log(data);
                });
        });
    });

    function drawMaps() {
        //nominatim
        // console.log(CurrentPosition);
        maps = L.map('map').setView([CurrentPosition.lat, CurrentPosition.long], zoom);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Made With :hearts: By Wayan Setiawan'
        }).addTo(maps);
        L.marker([CurrentPosition.lat, CurrentPosition.long])
            .on('click',(e) =>{
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
                .bindPopup("Mark saya")
                .addTo(maps);
            }
        });
    }

    // function showDeskripsi(index){
    //     let tmp_data = $.parseJSON(data_villa);
    //     console.log(tmp_data[index]);
    //     ck_edit.setData(tmp_data[index].deskripsi);
    //     $("#nama_modal").val(tmp_data[index].nama_villa);
    //     $("#alamat_modal").val(tmp_data[index].alamat_villa);
    //     $("#harga_modal").val(tmp_data[index].harga_villa);
    //     $("#status_modal").val(tmp_data[index].status);
    //     $("#deskripsi_modal").html(tmp_data[index].deskripsi);
    //     $("#lat_modal").val(tmp_data[index].latitude);
    //     $("#long_modal").val(tmp_data[index].longitude);
    //     $("#id_villa_modal").val(tmp_data[index].id_villa);
    //     $("#modalDeskripsi").modal('show');
    // }



    function getAddress(lat, long) {
        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${long}`, function (data) {
            console.log(data);
            $("#alamat").val(data.display_name);
            $("#lat").val(lat);
            $("#long").val(long);
        });
    }

</script>
@endsection

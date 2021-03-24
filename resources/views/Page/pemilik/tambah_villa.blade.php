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
                        <form method="POST" action="">
                            {{ csrf_field() }}
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 15%;">Nama</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="nama" class="form-control" name="nama"
                                            placeholder="Nama Villa" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Alamat</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="alamat" class="form-control" name="alamat"
                                            placeholder="Alamat Villa" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">Harga</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="alamat" class="form-control" name="alamat"
                                            placeholder="Harga Villa" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">Status</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="alamat" class="form-control" name="alamat"
                                            placeholder="status" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">About Villa</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><textarea class="form-control" rows="4" id="input-9" name="aboutuser" required></textarea>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">Latitude</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="lat" class="form-control" name="latitude"
                                            placeholder="Latitude" required readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Longitude</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="long" class="form-control" name="longitude"
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
    var centerLatLang = {
        latitude: "-8.6632685",
        longitude: "115.2143579"
    };
    var CurrentPosition = "";
    var maps = "";
    var circle = "";
    var zoom = 14;

    $(document).ready(() => {
        ckeditor = CKEDITOR.replace('deskripsi');
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

        $("#btnCari").click(function () {
            let keyword = $("#addr").val();
            $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + keyword,
                function (data) {
                    console.log(data);
                });
        });
    });

    function drawMaps() {
        // Init Map, Pilih Salah Satu
        //nominatim
        maps = L.map('map').setView([centerLatLang.latitude, centerLatLang.longitude], zoom);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Made With :hearts: By Wayan Setiawan'
        }).addTo(maps);
    }

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

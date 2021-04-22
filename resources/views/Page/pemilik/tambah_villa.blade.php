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
                                    <td><input type="text" id="harga" class="form-control number" name="harga"
                                            placeholder="Harga Villa" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">Fasilitas</td>
                                    <td style="width: 1%;"> : </td>
                                    <td>

                                        <div class="row">
                                            @foreach ($fasilitas as $item)
                                            <div class="col-xl-4">
                                                <div class="icheck-material-primary">
                                                    <input type="checkbox" name="fasilitas[]" value="{{$item->id_fasilitas}}" id="{{$item->id_fasilitas}}" />
                                                    <label for="{{$item->id_fasilitas}}">{{$item->nama_fasilitas}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%;">Status</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><select name="status" id="status" class="form-control input-shadow" placeholder="Status Villa" required>
                                        <option value="available">available</option>
                                        <option value="not available">not available</option>
                                    </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 15%">Select File</td>
                                    <td style="width: 1%"> : </td>
                                    <td><input type="file" class="form-control" id="input-8" name="file[]" required multiple></td>
                                <tr>


                                <tr>
                                    <td style="width: 15%;">About Villa</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><textarea class="form-control" rows="4" id="input-9" name="deskripsi" required></textarea>
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

<!-- Modal -->
<div class="modal fade" id="modalDeskripsi">
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
                            <td><input type="text" id="nama_modal" class="form-control" name="nama">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Alamat</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="alamat_modal" class="form-control" name="alamat">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Harga</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="number" id="harga_modal" class="form-control" name="harga">
                            </td>
                        </tr>


                        <tr>
                            <td style="width: 15%;">Status</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="status_modal" class="form-control" name="status"
                                    placeholder="status" required>
                            </td>
                        </tr>
                            <td style="width: 15%;">About Villa</td>
                            <td style="width: 1%;"> : </td>
                            <td><textarea name="deskripsi" class="form-control" id="deskripsi_modal"></textarea>
                            </td>
                        </tr>
                        </tr>
                        <div class="form-group row">
                            <label for="input-8" class="col-sm-2 col-form-label">Select File</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="input-8" name="file" required>
                            </div>

                        <tr>
                            <td style="width: 15%;">Latitude</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="lat_modal" class="form-control" name="latitude"
                                    placeholder="Latitude" required readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Longitude</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="long_modal" class="form-control" name="longitude"
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

@include('komponen.ckeditor')

<script type="text/javascript">
    var CurrentPosition = "";
    var maps = "";
    var circle = "";
    var zoom = 14;
    var data_villa = @json($data_villa);
    var user_marker ="";

    $(document).ready(() => {
        // console.log(data_villa);
        ckeditor = CKEDITOR.replace('deskripsi');
        ck_edit = CKEDITOR.replace('deskripsi_modal');
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
        //nominatim
        // console.log(CurrentPosition);
        maps = L.map('map').setView([CurrentPosition.lat, CurrentPosition.long], zoom);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Made With :hearts: By Wayan Setiawan'
        }).addTo(maps);

        $.each($.parseJSON(data_villa), (index, value)=>{
            console.log(value);
            L.marker([value.latitude, value.longitude])
            .on('click',(e) =>{
                showDeskripsi(index);
            })
            .addTo(maps);
        })

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

    function showDeskripsi(index){
        let tmp_data = $.parseJSON(data_villa);
        console.log(tmp_data[index]);
        ck_edit.setData(tmp_data[index].deskripsi);
        $("#nama_modal").val(tmp_data[index].nama_villa);
        $("#alamat_modal").val(tmp_data[index].alamat_villa);
        $("#harga_modal").val(tmp_data[index].harga_villa);
        $("#status_modal").val(tmp_data[index].status);
        $("#deskripsi_modal").html(tmp_data[index].deskripsi);
        $("#lat_modal").val(tmp_data[index].latitude);
        $("#long_modal").val(tmp_data[index].longitude);
        $("#id_villa_modal").val(tmp_data[index].id_villa);
        $("#modalDeskripsi").modal('show');
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

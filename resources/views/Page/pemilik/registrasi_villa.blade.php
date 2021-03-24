@extends('Page.master')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Pura</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            {{ csrf_field() }}
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 15%;">Nama</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="nama" class="form-control" name="nama"
                                            placeholder="Nama Pura" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Alamat</td>
                                    <td style="width: 1%;"> : </td>
                                    <td><input type="text" id="alamat" class="form-control" name="alamat"
                                            placeholder="Alamat" required>
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
@endsection

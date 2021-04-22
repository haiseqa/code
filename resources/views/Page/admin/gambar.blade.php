@extends('Page.master')
@section('content')
<div class="card">
    <div class="card-header"><i class="#"></i>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalgambar">Tambah Gambar</a></div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="default-datatable" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($image as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->path) }}" style="width: 100px" alt="">
                            </td>
                            <td>
                                <a href="{{route('pemilik.deletegaleri', [$item->id_foto_villa])}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="Modalgambar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pemilik.tambahgaleri', [$idvilla])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 15%;">Gambar</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="file" id="input-8" class="form-control" name="file[]" required multiple>
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

<script type="text/javascript">
    var centerLatLang = {
        latitude: "-8.6632685",
        longitude: "115.2143579"
    };
    var CurrentPosition = "";
    var maps = "";
    var circle = "";
    var zoom = 13;

    $(document).ready(() => {
        $('#default-datatable').DataTable({
            "columnDefs": [
                { "width": "20%", "targets": 1 }
            ]
        });
    });
</script>
@endsection

@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Lokasi Wisata
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalwisata">Tambah Lokasi Wisata</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table id="default-datatable" class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Wisata</th>
              <th scope="col">Longitude</th>
              <th scope="col">Latitude</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        <tbody>
            <?php $no = 0;?>
            @foreach ($lokasiwisata as $item)
            <?php $no++ ;?>
            <tr>
                <th scope="row">{{$no}}</th>
                <td>{{$item->nama_wisata}}</td>
                <td>{{$item->latitude}}</td>
                <td>{{$item->longitude}}</td>

                <td>
                    <form id="form_{{$item->id_lokasi_wisata}}" class="formdelete"
                        action="{{route('admin.delete.lokasi_wisata',[$item->id_lokasi_wisata])}}">
                        <a href="{{route('admin.edit.lokasi_wisata', [$item->id_lokasi_wisata])}}"
                            class="btn btn-primary">Edit</a>
                        <button type="button"  id="{{$item->id_lokasi_wisata}}" class="btn btn-danger btndelete">Delete</button>
                    </form>

                </td>
              </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
  </div>

  <div class="modal fade" id="Modalwisata">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Lokasi Wisata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.tambah.lokasi_wisata')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 15%;">Nama</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="nama_modal" class="form-control" name="nama_wisata">
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 15%;">Latitude</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="lat_modal" class="form-control" name="latitude"
                                placeholder="Longitude" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Longitude</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="long_modal" class="form-control" name="longitude"
                                placeholder="Latitude" required >
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



  <script>
    $(document).ready(function() {
     //Default data table
       $('#pemilik').DataTable();

       $('.btndelete').on('click',function(event){
          event.preventDefault();
          let idform = this.id;
          let form = $("#form_"+ idform);
          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons:true,
              dangerMode:true
          }).
          then((value) => {
                if (value) {
                    // swal("Poof! Your imaginary file has been deleted!", {
                    //     icon: "success",
                    //   });
                      form.submit();
                    } else {
                    //   swal("Your imaginary file is safe!");
                    }
                  });
              });



      var table = $('#example').DataTable( {
       lengthChange: false,
       buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
     } );

    table.buttons().container()
       .appendTo( '#example_wrapper .col-md-6:eq(0)' );

     } );

   </script>
@endsection

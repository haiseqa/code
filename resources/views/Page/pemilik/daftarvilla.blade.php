@extends('Page.master')

@section('content')

<div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Villa
        {{-- <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#addvilla">Add Villa</button> --}}
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table id="default-datatable" class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Villa</th>
              <th scope="col">Alamat</th>
              <th scope="col">Harga</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">longitude</th>
              <th scope="col">latitude</th>
              <th scope="col">status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        <tbody>
            @foreach ($villa as $item)

            <tr>
                <th scope="row"></th>
                <td>{{$item->nama_villa}}</td>
                <td>{{$item->alamat_villa}}</td>
                <td>{{$item->harga_villa}}</td>
                <td>{!!$item->deskripsi!!}</td>
                <td>{{$item->longitude}}</td>
                <td>{{$item->latitude}}</td>
                <td>{{$item->status_villa === 'enable' ? "Aktif" : "Tidak Aktif"}}</td>

                <td>
                    <form id="form_{{$item->id_villa}}" class="formdelete"
                        action="{{route('pemilik.delete_villa',[$item->id_villa])}}">
                        <a href="{{route('pemilik.detail_villa', [$item->id_villa])}}" button type="submit" class="btn btn-primary">detail</button></a>
                        <a href="{{route('pemilik_villa.galeri', [$item->id_villa])}}" button type="submit" class="btn btn-success">Gambar</button></a>
                    <button type="button" id="{{$item->id_villa}}" class="btn btn-danger btndelete">Delete</button>
                    </form>
                </td>

            </tr>

            @endforeach
        </tbody>

    </table>
    </div>
    </div>
  </div>

  <!-- Modal Edit -->
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

  <script>
    $(document).ready(function() {
     //Default data table
      $('#default-datatable').DataTable();

      $('.btndelete').on('click',function(event){
          event.preventDefault();
          let idform = this.id;
          let form = $("#form_"+ idform);
          swal({
              title: "Are you sure want to delete?",
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

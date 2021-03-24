@extends('Page.master')

@section('content')

<div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Villa
        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#addvilla">Add Villa</button>
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
              <th scope="col">longitude</th>
              <th scope="col">latitude</th>
              <th scope="col">status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        {{-- <tbody>
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

              </tr>
        </tbody> --}}
    </table>
    </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addvilla" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-full-width">
      <div class="modal-content modal-content-full-width">
        <div class="modal-header modal-header-full-width">
          <h5 class="modal-title modal-title-full-width" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-4">
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
                        <div class="col-xl-8">
                            <div id="map" style="height: 450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
     //Default data table
      $('#default-datatable').DataTable();

      $('.formdelete').on('click',function(event){
          event.preventDefault();
          let form = $(this);
          swal({
              title: "hapus?",
              text: "hapus pemilik villa",
              icon: "warning",
              buttons:true,
              dangerMode:true
          }).then((value)=>{
              if (value) {
                form.submit();
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

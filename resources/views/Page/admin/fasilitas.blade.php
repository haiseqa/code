@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Fasilitas
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalfasilitas">Tambah Fasilitas</a>
    </div>

    <div class="card-body">
      <div class="table-responsive">
      <table id="default-datatable" class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        <tbody>

            @foreach ($fasilitas as $item)
            <tr>

                <th scope="row"></th>
                <td>{{$item->nama_fasilitas}}</td>
                <td>
                    <form class="formdelete"
                        action="#">
                        <a href="{{route('admin.edit_fasilitas', [$item->id_fasilitas])}}"
                            class="btn btn-primary">Edit</a>
                        <button type="submit"  id="btnHapus" class="btn btn-danger">Delete</button>
                    </form>

                </td>
              </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
  </div>

  {{-- Modal --}}
<div class="modal fade" id="Modalfasilitas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.tambah_fasilitas')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 15%;">Nama</td>
                            <td style="width: 1%;"> : </td>
                            <td><input type="text" id="nama_modal" class="form-control" name="nama">
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
    //   $('#default-datatable').DataTable();

      $('.#btnHapus').on('click',function(event){
          event.preventDefault();
          let form = $(".formdelete");
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

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
              <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Harga</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        <tbody>
            {{-- @foreach ($villa as $item) --}}

            <tr>
                <th scope="row"></th>
                {{-- <td>{{$item->nama_villa}}</td>
                <td>{{$item->alamat_villa}}</td>
                <td>{{$item->harga_villa}}</td>
                <td>{!!$item->deskripsi!!}</td>
                <td>{{$item->longitude}}</td>
                <td>{{$item->latitude}}</td>
                <td>{{$item->status_villa === 'enable' ? "Aktif" : "Tidak Aktif"}}</td> --}}

                <td>
                    <form id="form_" class="formdelete"
                        action="">
                        <a href="" button type="submit" class="btn btn-primary">detail</button></a>
                        <a href="" button type="submit" class="btn btn-success">Gambar</button></a>
                    <button type="button" id="" class="btn btn-danger btndelete">Delete</button>
                    </form>
                </td>

            </tr>

            {{-- @endforeach --}}
        </tbody>

    </table>
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

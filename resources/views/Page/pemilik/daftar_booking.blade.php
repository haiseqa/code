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
              <th scope="col">Email</th>
              <th scope="col">No HP</th>
              <th scope="col">Waktu Booking</th>
              <th scope="col">Status Booking</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        <tbody>
            @foreach ($boooking as $item)

            <tr>
                <th scope="row"></th>
                <td>{{$item->nama_booking}}</td>
                <td>{{$item->Alamat}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->nohp}}</td>
                <td>{{$item->waktu_booking}}</td>
                <td>{{$item->status_booking === null ? "Booking" : ($item->status_booking === '1' ? "Selesai" : "Batal")}}</td>
                {{-- <td>{{$item->status_villa === 'enable' ? "Aktif" : "Tidak Aktif"}}</td> --}}

                <td>
                    <a href="{{route('pemilik.change_status', [$item->id_booking, '1'])}}"  class="btn btn-primary">Selesai</a>
                    <a href="{{route('pemilik.change_status', [$item->id_booking, '0'])}}"  class="btn btn-danger">Batal</a>
                </td>

            </tr>

            @endforeach
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

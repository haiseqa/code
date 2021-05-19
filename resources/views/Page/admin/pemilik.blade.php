@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-header"><i class="fa fa-table"></i>Data Pemilik</div>
    <div class="card-body">
      <div class="table-responsive">
      <table id="default-datatable" class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Alamat</th>
              <th scope="col">No Hp</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
        <tbody>
            @foreach ($pemilik as $item)
            <tr>
                <th scope="row"></th>
                <td>{{$item->nama}}</td>
                <td>{{$item->jenis_kelamin}}</td>
                <td>{{$item->alamat}}</td>
                <td>{{$item->nohp}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->status_pemilik ==='enable'? "aktif" : "Tidak Aktif"}}</td>


                <td>
                    @if($item->status_pemilik === 'enable')
                    <form action="{{route('admin.change_status_pemilik', ['disable'])}}" method="get">
                        <input type="text" name="id_pemilik" value="{{$item->id_pemilik}}" hidden>
                        <button type="submit" id="btnEdit" class="btn btn-danger">Disable</button>
                        <a href="{{route('admin.pemilik.edit', [$item->id_pemilik])}}" button type="submit" class="btn btn-primary">Edit</button></a>
                    </form>
                    @else
                    <form action="{{route('admin.change_status_pemilik', ['enable'])}}" method="get">
                        <input type="text" name="id_pemilik" value="{{$item->id_pemilik}}" hidden>
                        <button type="submit" id="btnEdit" class="btn btn-success">Active</button>
                        <a href="{{route('admin.pemilik.edit', [$item->id_pemilik])}}" button type="submit" class="btn btn-primary">Edit</button></a>
                    </form>
                    @endif

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

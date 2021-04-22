@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>
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

                <td>
                    <form class="formdelete"
                        action="{{route('admin.pemilik.delete',[$item->id_user])}}">
                        <a href="{{route('admin.pemilik.edit', [$item->id_pemilik])}}"
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

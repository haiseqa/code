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
            <?php $no = 0;?>
            @foreach ($villa as $item)
            <?php $no++ ;?>
            <tr>
                <th scope="row">{{$no}}</th>
                <td>{{$item->nama_villa}}</td>
                <td>{{$item->alamat_villa}}</td>
                <td>{{$item->harga_villa}}</td>
                <td>{!!$item->deskripsi!!}</td>
                <td>{{$item->longitude}}</td>
                <td>{{$item->latitude}}</td>
                <td>{{$item->status_villa ==='enable'? "aktif" : "Tidak Aktif"}}</td>
                <td>
                    @if($item->status_villa === 'enable')
                    <form action="{{route('admin.pemilik.status', ['disable'])}}" method="get">
                        <input type="text" name="id_villa" value="{{$item->id_villa}}" hidden>
                        <button type="submit" id="btnEdit" class="btn btn-danger">Disable</button>
                        <a href="{{route('admin.detail_villa', [$item->id_villa])}}" button type="submit" class="btn btn-primary">detail</button></a>
                        {{-- <a href="{{route('admin.galeri', [$item->id_villa])}}" button type="submit" class="btn btn-success">Gambar</button></a> --}}
                    </form>
                    @else
                    <form action="{{route('admin.pemilik.status', ['enable'])}}" method="get">
                        <input type="text" name="id_villa" value="{{$item->id_villa}}" hidden>
                        <button type="submit" id="btnEdit" class="btn btn-success">Active</button>
                        <a href="{{route('admin.detail_villa', [$item->id_villa])}}" button type="submit" class="btn btn-primary">detail</button></a>
                        {{-- <a href="{{route('pemilik_villa.galeri', [$item->id_villa])}}" button type="submit" class="btn btn-success">Gambar</button></a> --}}

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

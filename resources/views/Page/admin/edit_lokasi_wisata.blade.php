@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-body">
    <div class="card-title text-primary">Edit Fasilitas</div>
    <hr>
     <form method="POST">
         {{ csrf_field() }}
    <div class="form-group">
     <label for="input-1">Nama Wisata</label>
     <input type="text" class="form-control" name="nama_wisata" value="{{$lokasiwisata->nama_wisata}}" id="input-1" placeholder="Enter Name Wisata ">
     <label for="input-1">Latitude</label>
     <input type="text" class="form-control" name="latitude" value="{{$lokasiwisata->latitude}}" id="input-1" placeholder="Enter Longitude Wisata ">
     <label for="input-1">Longitude</label>
     <input type="text" class="form-control" name="longitude" value="{{$lokasiwisata->longitude}}" id="input-1" placeholder="Enter Latitude ">
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="window.history.back();">CANCEL</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
    </div>
   </form>
  </div>
  @endsection

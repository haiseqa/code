@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-body">
    <div class="card-title text-primary">Edit Fasilitas</div>
    <hr>
     <form method="POST">
         {{ csrf_field() }}
    <div class="form-group">
     <label for="input-1">Nama Fasilitas</label>
     <input type="text" class="form-control" name="nama" value="{{$fasilitas->nama_fasilitas}}" id="input-1" placeholder="Enter Your Fasilitas ">
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="window.history.back();">CANCEL</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
    </div>
   </form>
  </div>
  @endsection

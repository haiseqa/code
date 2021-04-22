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
     <button type="submit" class="btn btn-primary shadow-primary px-5"><i class="icon-lock"></i> Edit</button>
   </div>
   </form>
  </div>
  @endsection

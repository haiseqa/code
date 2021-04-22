@extends('Page.master')
@section('content')

<div class="card">
    <div class="card-body">
    <div class="card-title text-primary">Edit Pemilik</div>
    <hr>
     <form method="POST">
         {{ csrf_field() }}
    <div class="form-group">
     <label for="input-1">Nama Lengkap</label>
     <input type="text" class="form-control" name="nama" value="{{$editpemilik->nama}}" id="input-1" placeholder="Enter Your Name">
    </div>
    <div class="form-group">
     <label for="input-2">Jenis Kelamin</label>
     <input type="text" class="form-control" name="gender" value="{{$editpemilik->jenis_kelamin}}" id="input-2" placeholder="Enter Your Email Address">
    </div>
    <div class="form-group">
     <label for="input-3">Alamat</label>
     <input type="text" class="form-control" name="address"  value="{{$editpemilik->alamat}}" id="input-3" placeholder="Enter Your Mobile Number">
    </div>
    <div class="form-group">
     <label for="input-4">No Hp</label>
     <input type="text" class="form-control" name="number" value="{{$editpemilik->nohp}}" id="input-4" placeholder="Enter Password">
    </div>
    <div class="form-group">
     <label for="input-5">Email</label>
     <input type="text" class="form-control" name="email" value="{{$editpemilik->email}}" id="input-5" placeholder="Confirm Password">
    </div>

    <div class="form-group">
     <button type="submit" class="btn btn-primary shadow-primary px-5"><i class="icon-lock"></i> Edit</button>
   </div>
   </form>
  </div>
  @endsection

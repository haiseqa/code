@extends('Page.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        <img class="rounded-circle" width="150" src="{{ empty($user->foto_profile) ? asset('dashboard/images/user.png') : asset($user->foto_profile) }}">

                        <h4 class="card-title" style="margin-top: 15px">{{$user->nama}}</h4>
                        <h6 class="card-subtitle">{{$user->username}}</h6>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#profile"><i class="icon-user"></i> <span
                                    class="hidden-xs">Profile</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#editProfile"><i class="zmdi zmdi-edit"></i> <span
                                    class="hidden-xs">Edit Profile</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#editPassword"><i class="zmdi zmdi-edit"></i> <span
                                    class="hidden-xs">Ubah Password</span></a>
                        </li>
                    </ul>

                    <!-- Tab profile -->
                    <div class="tab-content">
                        <div id="profile" class="container tab-pane active">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-6 border-right">
                                        <strong>Username</strong>
                                        <p class="text-muted">{{$user->username}}</p>
                                    </div>

                                    <div class="col-sm-6 ">
                                        <strong>Nama</strong>
                                        <p class="text-muted">{{$user->nama}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <strong>Email</strong>
                                        <p class="text-muted">{{$user->email}}</p>
                                    </div>

                                    <div class="col-sm-6 ">
                                        <strong>No Hp</strong>
                                        <p class="text-muted">{{$user->nohp}}</p>
                                    </div>

                                    <div class="col-sm-6 border-right">
                                        <strong>Alamat</strong>
                                        <p class="text-muted">{{$user->alamat}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Tab edit profile -->
                        <div id="editProfile" class="container tab-pane fade">
                            <form method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="idpemilik" hidden value="{{$user->id_pemilik}}">
                                        <input type="text" class="form-control" value="{{$user->username}}" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama" value="{{$user->nama}}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nohp" value="{{$user->nohp}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="alamat" value="{{$user->alamat}}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Foto Profile</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="fileProfile">
                                    </div>
                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Update">
                            </form>
                        </div>

                        <!-- Tab edit password -->
                        <div id="editPassword" class="container tab-pane fade">
                            <form method="post" action="{{route('pemilik.profile_profile.password')}}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Password Lama</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="oldPassword">
                                        <input type="text" class="form-control" name="iduser" hidden value="{{$user->id_user}}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="newPassword">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

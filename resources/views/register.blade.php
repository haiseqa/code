@extends('master')

@section('konten')
@include('komponen.datepicker')
<div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
        <div class="card-content p-2">
            <div class="text-center">
                <img src="{{ asset('dashboard/images/logo1-icon.png') }}" alt="logo icon">
            </div>
            <div class="card-title text-uppercase text-center py-3">Register</div>
            <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputUsername" class="">Nama Lengkap</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" name="nama" id="exampleInputUsername" class="form-control input-shadow"
                            placeholder="Enter Name">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername" class="">Username</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" name="username" id="exampleInputUsername" class="form-control input-shadow"
                            placeholder="Enter Username">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputGender" class="">Gender</label>
                    <div class="position-relative has-icon-right">
                        {{-- <input type="text" name="gender" id="exampleInputUsername" class="form-control input-shadow"> --}}
                        <select name="gender" id="" class="form-control input-shadow">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="form-control-position">
                            <i class="zmdi zmdi-male-female"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputAlamat" class="">Alamat</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" name="address" id="exampleInputAlamat" class="form-control input-shadow"
                            placeholder="Enter Address">
                        <div class="form-control-position">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail" class="">Email</label>
                    <div class="position-relative has-icon-right">
                        <input type="email" name="email" id="exampleInputNomorHp" class="form-control input-shadow"
                            placeholder="Enter Email">
                        <div class="form-control-position">
                            <i class="zmdi zmdi-email"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword" class="">Nomor Hp</label>
                    <div class="position-relative has-icon-right">
                        <input type="number" name="number" id="exampleInputNomorHp" class="form-control input-shadow"
                            placeholder="Enter Number Phone">
                        <div class="form-control-position">
                            <i class="zmdi zmdi-local-phone"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword" class="">Password</label>
                    <div class="position-relative has-icon-right">
                        <input type="password" name="password" id="exampleInputPassword" class="form-control input-shadow"
                            placeholder="Enter Password">
                        <div class="form-control-position">
                            <i class="icon-lock"></i>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-primary shadow-primary btn-block waves-effect waves-light">Daftar</button>
            </form>
        </div>
    </div>
    <div class="card-footer text-center py-3">
        <p class="text-muted mb-0">Have an Account? <a href="{{route('login')}}"> Login</a></p>
    </div>
</div>
<script>
    $(document).ready(()=>{
        $('#tanggal_lahir').bootstrapMaterialDatePicker({
            time:false
        });
    });
</script>
@endsection

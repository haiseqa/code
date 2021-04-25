@extends('master')

@section('konten')

@endsection

	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="{{ asset ('dashboard/images/logo-icon.png') }}" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
            <form action="{{route('login')}}" method="POST">
                {{ csrf_field() }}
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
                    <label for="exampleInputPassword" class="">Password</label>
                    <div class="position-relative has-icon-right">
                        <input type="password" name="password" id="exampleInputPassword" class="form-control input-shadow"
                            placeholder="Enter Password">
                        <div class="form-control-position">
                            <i class="icon-lock"></i>
                        </div>
                    </div>
                </div>


			 <button type="submit" class="btn btn-primary shadow-primary btn-block waves-effect waves-light">Sign In</button>

			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-muted mb-0">Do not have an account? <a href="{{route('register')}}"> Sign Up here</a></p>
		  </div>
	     </div>

